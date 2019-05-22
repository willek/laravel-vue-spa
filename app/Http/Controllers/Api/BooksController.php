<?php

namespace App\Http\Controllers\Api;

use App\Entities\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::paginate(5));
    }

    public function created(Request $request)
    {
        $data = $request->validate([
          'title'       => 'required',
          'description' => 'required',
          'year'        => 'required|numeric|digits:4'
        ]);

        $book = Book::create($data);

        return response(null, 200);
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function update(Book $book, Request $request)
    {
        $data = $request->validate([
          'title'       => 'required',
          'description' => 'required',
          'year'        => 'required|numeric|digits:4'
        ]);

        $book->update($data);

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response(null, 204);
    }
}
