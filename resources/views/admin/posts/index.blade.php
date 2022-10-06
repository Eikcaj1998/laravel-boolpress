
@extends('layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h1>Lista Post</h1>
        <a class="btn btn-success" href="{{ route('admin.posts.create') }}">
            <i class="fa-solid fa-plus my-2"></i> Nuovo Post</a>
        <form action='' method="">
            <div class="input-group">
                <select name="selected_category" class="custom-select">
                    <option value="">Tutte le categorie</option>
                    @foreach ($categories as $category)
                        <option @if ($category->id == $selected_category) selected @endif value={{ $category->id }}>
                            {{ $category->label }} </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Filtra</button>
                </div>
            </div>
        </form>
    </header>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Autore</th>
                <th scope="col">Categoria</th>
                <th scope="col">Stato</th>
                <th scope="col">Creato il</th>
                <th scope="col">Modificato il</th>
                <th scope="col" class="text-center">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if ($post->author)
                            {{ $post->author->name }}
                        @else
                            Anonimo
                        @endif
                    </td>
                    <td>
                        @if ($post->category)
                            <span class="badge badge-pill badge-{{ $post->category->color ?? 'light' }}">
                                {{ $post->category->label }}
                            @else
                                Nessuna
                        @endif
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.toggle', $post) }}" method='POST'>
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-outline type-submit">

                                <i
                                    class="fa-2x fa-solid fa-toggle-{{ $post->is_published ? 'on' : 'off' }} 
                                    text-{{ $post->is_published ? 'success' : 'danger' }}">
                                </i>
                            </button>
                        </form>
                    </td>
                    <th>{{ $post->created_at }}</th>
                    <th>{{ $post->updated_at }}</th>
                    <td class="d-flex justify-content-between">
                        <a class="btn btn-sm mr-2 btn-primary" href="{{ route('admin.posts.show', $post) }}">
                            <i class="fa-solid fa-eye"></i> 
                        </a>
                        @if($post->user_id === Auth::id())
                        <a class="btn btn-sm mr-2 btn-warning" href="{{ route('admin.posts.edit', $post) }}">
                            <i class="fa-solid fa-pencil"></i> 
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                <i class="fa-solid fa-trash"></i> 
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <h3 class="text-center">Nessun Post</h3>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <nav class="mt-3">
        @if ($posts->hasPages())
            {{ $posts->links() }}
        @endif
    </nav>
    <section class="m-5" id="category-posts">
        <h2 class="mb-2">Post By Category</h2>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-3">
                    <h3 class="my-3">{{ $category->label }} ({{ count($category->posts) }})</h3>
                    @forelse ($category->posts as $post)
                        <p><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></p>
                    @empty
                        nessun post
                    @endforelse
                </div>
            @endforeach
        </div>
    </section>
@endsection
