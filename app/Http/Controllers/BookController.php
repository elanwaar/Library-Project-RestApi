<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::all();
        return response()->json($book);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'collection' => 'required',
            'isbn' => 'required',
            'publish_date' => 'required',
            'pages_number' => 'required',
            'location' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);
        
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'collection' => $request->collection,
            'isbn' => $request->isbn,
            'publish_date' => $request->publish_date,
            'pages_number' => $request->pages_number,
            'location' => $request->location,
            'content' => $request->content,
            'category_id' => $request->category_id
        ]);
        return response()->json([
            'success' => 'Book has been added'
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'collection' => 'required',
            'isbn' => 'required',
            'publish_date' => 'required',
            'pages_number' => 'required',
            'location' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->collection = $request->collection;
        $book->isbn = $request->isbn;
        $book->publish_date = $request->publish_date;
        $book->pages_number = $request->pages_number;
        $book->location = $request->location;
        $book->content = $request->content;
        $book->category_id = $request->category_id;

        $book->save();

        return response()->json([
            'success' => 'Book has been updated'
        ]);
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
        return response()->json([
            'success' => 'Book has been deleted'
        ]);
    }

    public function getBooksByCategory($category_name)
    {
        if(Category::where('name', $category_name)->exists()){
            $category = Category::where('name', $category_name)->first();
            $books = Book::where('category_id', $category->id)->get();
            return response()->json($books);
        }
        else{
            return response()->json(['message' => 'Category not found'], 404);
        }
    }
}
