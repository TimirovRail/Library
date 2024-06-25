@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить книгу</h1>
    <form action="{{ route('librarian.books.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="genre">Жанр</label>
            <input type="text" name="genre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="publisher">Издатель</label>
            <input type="text" name="publisher" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="year">Год</label>
            <input type="number" name="year" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
</div>
@endsection
