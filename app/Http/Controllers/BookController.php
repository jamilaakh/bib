<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\Books\ReadBookEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Events\Books\CreateBookEvent;
use App\Events\Books\DeleteBookEvent;
use App\Events\Books\UpdateBookEvent;


class BookController extends Controller
{
    public function validationRules ($request, $id = null)
    {
        $uniqueTitleRule = $id ? "unique:books,title,$id" : "unique:books,title";
        $request->validate([
            "title"       => "required|string|min:10|max:50|$uniqueTitleRule",
            "description" => "max:100",
            "editor"      => "max: 20",
            "price"       => "required|numeric|min:0",
            "author"      => "max:20",
            "cover"       => "image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ],[
            "title.required" => "Tite field is required",
            "title.min"      => "Title must be at least 10 characters",
            "title.max"      => "Title can't be more than 50 characters",
            "description.max"=> "Description can't be more than 100 characters",
            "price.required" => "Price field is required",
            "price.numeric"  => "Price must be a number",
            "price.min"      => "Price must be a positive value",
            "author.max"     => "Author can't be more than 20 characters",
            "cover.image"    => "Uploaded file must be an image",
            "cover.mimes"    => "Uploaded image must be valid",
            "cover.max"      => "The image size is over 2mb"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $books = Book::orderBy("id", "desc");

        if ($request->order) $books = Book::orderBy($request->order, "asc");
        if ($request->category) $books = $books->where("category", $request->category);
        if ($request->type) $books = $books->whereIn("type", $request->type);
        if ($request->min) $books = $books->where("price", ">=", $request->min);
        if ($request->max) $books = $books->where("price", "<=", $request->max);

        $count = $books->count();

        return view('book.index', [
            "books" => $books->paginate(15),
            "count" => $count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("book.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validationRules($request);

        // $request->validate([
        //     "name" => "required|string1"
        // ]);

        $cover = $request->file("cover");
        $cover_name = null;
        if ($cover) {
            $cover_name = time() . "." . $cover->getClientOriginalExtension();
            $cover->move(public_path("assets/img/book"), $cover_name);
        }

        $book = Book::create([
            "title"         => $request->input("title"),
            "description"   => $request->input("description") ?? "No description",
            "type"          => $request->input("type"),
            "language"      => $request->input("language"),
            "editor"        => $request->input("editor") ?? "Anonymous",
            "category"      => $request->input("category"),
            "price"         => $request->input("price"),
            "author"        => $request->input("author") ?? "Anonymous",
            "cover"         => $cover_name ?? "no_cover.png",
        ]);

        CreateBookEvent::dispatch($book);

        return redirect()->route("books.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        ReadBookEvent::dispatch($book);
        return view("book.show", compact("book"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view("book.edit", compact("book"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validationRules($request, $id);
        
        $book = Book::findOrFail($id);

        $book->title = $request->input("title");
        $book->description = $request->input("description") ?? "No description";
        $book->type = $request->input("type");
        $book->category = $request->input("category");
        $book->editor = $request->input("editor") ?? "Anonymous";
        $book->language = $request->input("language");
        $book->price = $request->input("price");
        $book->author = $request->input("author") ?? "Anonymous";

        $cover = $request->file("cover");

        if (isset($cover)) {
            if ($book->cover != "no_cover.png" && File::exists(public_path('assets/img/book/' . $book->cover))) {
                File::delete(public_path("assets/img/book/". $book->cover));
            }
            $cover_name = time() . "." . $cover->getClientOriginalExtension();
            $cover->move(public_path("assets/img/book"), $cover_name);

            $book->cover = $cover_name;
        }

        $book->save();
        UpdateBookEvent::dispatch($book);
        return redirect()->route("books.edit", $book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover != "no_cover.png") {
            if (File::exists(public_path('assets/img/book/' . $book->cover))) {
                File::delete(public_path("assets/img/book/". $book->cover));
            }
        }

        
        $book->delete();


        DeleteBookEvent::dispatch($book);
        return redirect()->route("books.index");
    }
}