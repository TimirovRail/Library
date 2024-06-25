<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class ClientController extends Controller
{
    public function index(Request $request)
{
    $query = Book::query();

    if ($request->has('search')) {
        $searchTerm = '%' . $request->search . '%';
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', $searchTerm)
              ->orWhere('author', 'like', $searchTerm)
              ->orWhere('genre', 'like', $searchTerm)
              ->orWhere('publisher', 'like', $searchTerm);
        });
    }

    // Загружаем отзывы для каждой книги
    $books = $query->with('reviews')->get();
    return view('client.books.index', compact('books'));
}

    public function reserveBook(Book $book)
    {
        // Проверяем, не забронирована ли уже книга
        if ($book->is_reserved) {
            return redirect()->back()->with('error', 'Книга уже забронирована.');
        }

        // Создаем новую запись о бронировании
        Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
        ]);

        // Отмечаем книгу как забронированную
        $book->update([
            'is_reserved' => true,
        ]);

        return redirect()->back()->with('success', 'Книга успешно забронирована.');
    }

    public function cancelReservation(Book $book)
    {
        // Находим запись о бронировании данной книги текущим пользователем
        $reservation = Reservation::where('user_id', Auth::id())
                                  ->where('book_id', $book->id)
                                  ->first();

        if (!$reservation) {
            return redirect()->back()->with('error', 'У вас нет бронирования этой книги.');
        }

        // Удаляем запись о бронировании
        $reservation->delete();

        // Отмечаем книгу как доступную для бронирования
        $book->update([
            'is_reserved' => false,
        ]);

        return redirect()->back()->with('success', 'Бронирование книги успешно отменено.');
    }

    public function addReview(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Проверяем, может ли пользователь оставить отзыв для этой книги (например, только после бронирования)

        BookReview::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Отзыв успешно добавлен.');
    }
}
