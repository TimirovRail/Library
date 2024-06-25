@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать книгу</h1>
    <form action="{{ route('librarian.books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>
        <div class="form-group">
            <label for="genre">Жанр</label>
            <input type="text" name="genre" class="form-control" value="{{ $book->genre }}" required>
        </div>
        <div class="form-group">
            <label for="publisher">Издатель</label>
            <input type="text" name="publisher" class="form-control" value="{{ $book->publisher }}" required>
        </div>
        <div class="form-group">
            <label for="year">Год</label>
            <input type="number" name="year" class="form-control" value="{{ $book->year }}" required>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>
@endsection
