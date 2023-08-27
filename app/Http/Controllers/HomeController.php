<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $member = member::with('user')->get();
        // $books = Book::with('Publisher')->get();
        $Books = Book::with ('Catalog')->get();

        return $Books;
        return view('home');
    }
}
