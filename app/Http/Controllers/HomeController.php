<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'librarian') {
            return redirect()->route('librarian.dashboard');
        } elseif ($user->role === 'client') {
            return redirect()->route('client.dashboard');
        }

        return view('home');
    }
}

