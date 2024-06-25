<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('librarian.books.index', compact('books'));
    }

    public function create()
    {
        return view('librarian.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('librarian.books.index');
    }

    public function edit(Book $book)
    {
        return view('librarian.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('librarian.books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('librarian.books.index');
    }

    public function loanBook(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $reservation = Reservation::find($request->reservation_id);

        // Проверяем, была ли уже выдана книга
        if ($reservation->is_loaned) {
            return redirect()->back()->with('error', 'Книга уже выдана.');
        }

        BookLoan::create([
            'book_id' => $reservation->book_id,
            'user_id' => $reservation->user_id,
            'borrowed_at' => now(),
        ]);

        $reservation->update([
            'is_loaned' => true,
        ]);

        return redirect()->route('librarian.books.index')->with('success', 'Книга успешно выдана.');
    }

    public function returnBook(BookLoan $loan)
    {
        $loan->update([
            'returned_at' => now(),
        ]);

        $reservation = Reservation::where('book_id', $loan->book_id)
            ->where('user_id', $loan->user_id)
            ->first();

        if ($reservation) {
            $reservation->update([
                'is_loaned' => false,
            ]);
        }

        return redirect()->route('librarian.books.index')->with('success', 'Книга успешно возвращена.');
    }
//незнаю
    public function loans()
    {
        $loans = BookLoan::whereNull('returned_at')->get();
        return view('librarian.books.loans', compact('loans'));
    }
}
