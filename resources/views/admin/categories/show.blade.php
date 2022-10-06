@extends('layouts.app')
@section('content')
    <header>
        <h1>
            {{ $category->title }}
        </h1>
    </header>
    <div class="clearfix">
        <p><strong>Color:</strong>{{ $category->color }}</p>
        <div>
            <strong><time>Creato il: {{ $category->created_at }}</time></strong>
            <div>

                <strong><time>Ultima modifica il: {{ $category->updated_at }}</time></strong>
            </div>
        </div>
    </div>
    <hr>
    <footer class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.categories.index') }}"class="btn btn-secondary">
            <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
        </a>
        <div class="d-flex align-items-center justify-content-end">
            <a class="btn mr-2 btn-warning p-1" href="{{ route('admin.categories.edit', $category) }}">
                <i class="fa-solid fa-pencil mr-2"></i> Modifica
            </a>

            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">
                    <i class="fa-solid fa-trash mr-2"></i> Elimina
                </button>
            </form>
        </div>
    </footer>
@endsection
