
@extends('layouts.app')

@section('content')
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">E-mail</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">Età</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Telefono</th>
                <th scope="col">N. Posts</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <th scope="col">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->userDetail->getFullName() }}</td>
                    <td>{{ $user->userDetail->getAge() }}</td>
                    <td>{{ $user->userDetail->address }}</td>
                    <td>{{ $user->userDetail->phone }}</td>
                    <td>{{ count($user->posts) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <h4>Nessun Post</h4>
                    </td>
                </tr>
            @endforelse
        </tbody>
    @endsection