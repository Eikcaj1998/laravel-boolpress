<?php
use App\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();
        $category_ids = Category::pluck('id')->toArray();

        for($i=0; $i < 10; $i++){
            $new_post = new Post();
            $new_post->title = $faker->text(20);
            $new_post->user_id = Arr::random($user_ids);
            $new_post->category_id = Arr::random($category_ids);
            $new_post->slug = Str::slug($new_post->title,'-');
            $new_post->content = $faker->paragraphs(2,true);
            //deccomento perche ora sara un file e non un url
            //$new_post->image = $faker->imageUrl(100,100);
            $new_post->is_published = $faker->boolean();

            $new_post->save();
        }
    }
}
