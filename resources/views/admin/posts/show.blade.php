@php
    $is_author = $post->user_id === Auth::id()
@endphp


@extends('layouts.app')
@section('content')
    <header>
        <h1>
            {{ $post->title }}
        </h1>
    </header>
    <div class="clearfix">
        @if ($post->image)
            <img class="float-left mr-2" src="{{ $post->image }}" alt="{{ $post->slug }}">
        @endif
        <p><strong>Categoria:</strong>
            @if ($post->category)
            {{$post->category->label}}
            @else Nessuna
            @endif
        </p>
        <p>{{ $post->content }}</p>
        <div>
            <strong>Creato il: <time>{{ $post->created_at }}</time></strong>
            <div>

                <strong>Ultima modifica il: <time>{{ $post->updated_at }}</time></strong>
            </div>

            <div>

                <strong>Autore <time>
                    @if ($post->author)
                    {{ $post->author->name }}
                </time></strong>
                @else Anonimo
                @endif
            </div>
        </div>
    </div>
    <hr>
    <footer class="d-flex align-items-center justify-content-{{$is_author ?  'between' : 'end'}}">
        <a href="{{ route('admin.posts.index') }}"class="btn btn-secondary">
            <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
        </a>
        @if($is_author)
        <div class="d-flex align-items-center justify-content-end">
            <a class="btn mr-2 btn-warning p-1" href="{{ route('admin.posts.edit', $post) }}">
                <i class="fa-solid fa-pencil mr-2"></i> Modifica
            </a>

            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">
                    <i class="fa-solid fa-trash mr-2"></i> Elimina
                </button>
            </form>
        </div>
        @endif
    </footer>
@endsection
