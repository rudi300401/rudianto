<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $catalogs = Catalog::all();
        return view('admin.book', compact('publishers', 'authors', 'catalogs'));
    }

    
    public function api()
    {
    $books = book::all();
    return json_encode($books);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'numeric',
            'title' => 'required|string',
            'year' => 'required|numeric',
            'publisher_id' => 'required',
            'author_id' => 'required',
            'catalog_id' => 'required|numeric',
            'qty' => 'numeric',
            'price' => 'numeric',
        ]);

        // Simpan data buku ke dalam database
        $book = new Book([
            'isbn' => $request->input('isbn'),
            'title' => $request->input('title'),
            'year' => $request->input('year'),
            'publisher_id' => $request->input('publisher_id'),
            'author_id' => $request->input('author_id'),
            'catalog_id' => $request->input('catalog_id'),
            'qty' => $request->input('qty'),
            'price' => $request->input('price'),
        ]);

        $book->save();

        return redirect()->back()->with('success', 'Data buku berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('admin.book');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request,[
            'isbn'  =>  ['required'],
            'title'  =>  ['required'],
            'year'  =>  ['required'],
            'publisher'  =>  ['required'],
            'author'  =>  ['required'],
            'catalog'  =>  ['required'],
            'qty'  =>  ['required'],
            'price'  =>  ['required'],
        ]);

        $book->update($request->all());

        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
    }
}
