<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "message" => "Here are all the books",
            "books" => Book::paginate(15),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create([
            "title"         => $request->title,
            "description"   => $request->description,
            "type"          => $request->type,
            "language"      => $request->language,
            "editor"        => $request->editor,
            "category"      => $request->category,
            "price"         => $request->price,
            "author"        => $request->author,
            "cover"         => "no_cover.png",
        ]);
        
        return response()->json([
            "message" => "Book Added",
            "book" => $book,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return response()->json([
            "message" => "Book Found",
            "book" => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return response()->json([
            "message" => "Book Updated",
            "book" => $book,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json([
            "message" => "Book Deleted",
            "book" => $book,
        ]);
    }
}
