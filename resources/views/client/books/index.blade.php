@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Книги</h2>
    <form action="{{ route('client.books.index') }}" method="GET">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Поиск по названию, автору, жанру, издателю">
        </div>
        <button type="submit" class="btn btn-primary">Поиск</button>
    </form>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Жанр</th>
                <th>Издатель</th>
                <th>Год</th>
                <th>Оценка</th>
                <th>Комментарий</th>
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
                    @if ($book->reviews->isNotEmpty())
                        {{ $book->reviews->avg('rating') }}
                    @else
                        Нет оценок
                    @endif
                </td>
                <td>
                    @if ($book->reviews->isNotEmpty())
                        <ul>
                            @foreach($book->reviews as $review)
                                <li>{{ $review->comment }}</li>
                            @endforeach
                        </ul>
                    @else
                        Нет комментариев
                    @endif
                </td>
                <td>
                    @if ($book->is_reserved)
                        <form action="{{ route('client.books.cancel', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Отменить бронь</button>
                        </form>
                    @else
                        <form action="{{ route('client.books.reserve', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Бронировать</button>
                        </form>
                    @endif

                    <form action="{{ route('client.books.addReview', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <div class="form-group">
                            <label for="rating">Оценка:</label>
                            <select name="rating" id="rating" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий:</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Оставить отзыв</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
