@extends('layouts.app')
@section('content')
    <header class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista Categorie</h1>
        <a class="btn btn-success" href="{{ route('admin.categories.create') }}">
            <i class="fa-solid fa-plus mr-2"></i> Nuove Categorie
        </a>
    </header>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Label</th>
                <th scope="col">Color</th>
                <th scope="col">Creato il</th>
                <th scope="col">Modificato il</th>
                <th scope="col" class="text-center">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->label }}</td>
                    <td>{{$category->color}}</td>
                    <th>{{ $category->created_at }}</th>
                    <th>{{ $category->updated_at }}</th>
                    <td class="d-flex justify-content-between">
                        <a class="btn btn-sm mr-2 btn-primary p-1" href="{{ route('admin.categories.show', $category) }}">
                            <i class="fa-solid fa-eye mr-2"></i> Vedi
                        </a>
                        <a class="btn btn-sm mr-2 btn-warning p-1" href="{{ route('admin.categories.edit', $category) }}">
                            <i class="fa-solid fa-pencil mr-2"></i> Modifica
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                <i class="fa-solid fa-trash mr-2"></i> Elimina
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <h3 class="text-center">Nessuna Categoria</h3>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <nav class="mt-3">
        @if ($categories->hasPages())
            {{ $categories->links() }}
        @endif
    </nav>
@endsection
