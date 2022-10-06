<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\PostPublicationMail;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selected_category = $request->query('selected_category');
        $query = Post::orderBy('updated_at','DESC')
        ->orderBy('created_at','DESC');
        $posts = $selected_category ? $query->where('category_id',$selected_category)->paginate(10) : $query->paginate(10);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts','categories','selected_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $post = new Post();
        $categories = Category::select('id','label')->get();
        return view('admin.posts.create', compact('post','categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|min:5|max:50|unique:posts',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'category_id'=>'nullable|exists:categories,id'
        ],
        [
            'title.required'=>'il Titolo e obbligatorio',
            'content.required'=>'il contenuto e obbligatorio',
            'title.min'=>'il Titolo deve avere almeno :min caratteri',
            'title.max'=>'il Titolo deve avere almeno :max caratteri',
            'title.unique'=>"Esiste già un post dal titolo $request->title",
            'image.mimes'=>'le immagini ammesse sono solo in formato .jpeg, .jpg o .png',
            'categy_id.exists'=>'Non esiste una categoria associabile',
        ]);

        $data = $request->all();
        $post = new Post;
        $post->fill($data);
        $post->slug = Str::slug($post->title,'-');
        $post->is_published = array_key_exists('is_published',$data);
        $current_user= Auth::user();
        $post->user_id = $current_user->id;
        if(array_key_exists('image',$data)){
            $image_url = Storage::put('posts',$data['image']);
            $post->image = $image_url;
        }
        $post->save();

        if($post->is_published){
            $mail = new PostPublicationMail($post);  
            $mail_addresses = User::where('id','<>',$post->user_id)->limit(3)->pluck('email')->toArray();
            foreach($mail_addresses as $mail_address){
                Mail::to($mail_address)->send($mail); 

            }
        };

        return redirect()->route('admin.posts.show', $post)
       ->with('message', 'Post creato con successo')
       ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       return view('admin.posts.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('admin.posts.index')
            ->with('message', "Non sei autorizzato a modificare questo post")
            ->with('type', "warning");
        }
        $categories= Category::select('id','label')->get();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post )
    {   
        $request->validate([
            'title' => ['required','string','min:5','max:50', Rule::unique('posts')->ignore($post->id)],
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'category_id'=> 'nullable|exists:categories,id'
        ],
        [
            'title.required'=>'il Titolo e obbligatorio',
            'content.required'=>'il contenuto e obbligatorio',
            'title.min'=>'il Titolo deve avere almeno :min caratteri',
            'title.unique'=>"Esiste già un post dal titolo $request->title",
            'image.mimes'=>'le immagini ammesse sono solo in formato .jpeg, .jpg o .png',
            'category_id'=>'Non esiste una categoria associabile'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'],'-');

        $data['is_published'] = array_key_exists('is_published',$data);

        $post->update($data);
        if(array_key_exists('image',$data)){
            $image_url = Storage::put('posts',$data['image']);
            $post->image = $image_url;
        }
        $post->save();
        return redirect()->route('admin.posts.show', $post)
       ->with('message', 'Post modificato con successo')
       ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('admin.posts.index')
            ->with('message', "Non sei autorizzato ad eliminare questo post")
            ->with('type', "warning");
        }
        if($post->image)Storage::delete($post->image);
       $post->delete();
       return redirect()->route('admin.posts.index')
       ->with('message', 'il post e stato eliminato con successo')
       ->with('type', 'danger');
    }

    public function toggle(Post $post)
    {
       $post->is_published= !$post->is_published;
       $post->save();

        $status = $post->is_published ? 'pubblicato' : 'rimosso';
       return redirect()->route('admin.posts.index')
       ->with('message',"Post $post->title $status con successo")
       ->with('type','success');
    }
}
