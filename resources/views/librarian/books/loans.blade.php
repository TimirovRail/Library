@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Выдача книг</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Книга</th>
                <th>Клиент</th>
                <th>Дата выдачи</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->id }}</td>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->borrowed_at }}</td>
                <td>
                    <form action="{{ route('librarian.books.return', $loan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Принять книгу</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
