@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Управление книгами</h1>
    <a href="{{ route('librarian.books.create') }}" class="btn btn-primary">Добавить книгу</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Жанр</th>
                <th>Издатель</th>
                <th>Год</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->year }}</td>
                <td>
                    <a href="{{ route('librarian.books.edit', $book->id) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('librarian.books.destroy', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                    @if (!$book->reservations->isEmpty() && !$book->reservations->first()->is_loaned)
                    <form action="{{ route('librarian.books.loan') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ $book->reservations->first()->id }}">
                        <button type="submit" class="btn btn-primary">Выдать книгу</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
