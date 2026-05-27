<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BookController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'ISBN' => 'required|string|max:10|unique:books',
            'available' => 'sometimes|integer|min:0',
        ]);
        try{
            Book::create([
                'title' => $data['title'],
                'ISBN' => $data['ISBN'],
                'available' => $data['available'] ?? 0,
            ]);
            return response()->json(['message' => 'Book created successfully'], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Error creating book'], 500);
        }

    }

    public function show()
    {
        $books = Book::all();
        if($books==null ||$books->isEmpty()) return response()->json(['message' => 'No books found'], 404);
        return response()->json(['message' => 'Books retrieved successfully', 'books' => $books], 201);
    }


    public function showSingle(int $id)
    {
        $book = Book::findOrFail($id);
        if($book==null || $book->isEmpty()) return response()->json(['message' => 'Book not found'], 404);
        return response()->json(['message' => 'Book retrieved successfully', 'book' => $book], 201);
    }

    public function edit(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'ISBN' => 'sometimes|string|max:10',
            'available' => 'sometimes|integer|min:0',
        ]);

        try {
            $book->update($data);
            return response()->json(['message' => 'Book updated successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating book'], 500);
        }
    }

    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return response()->json(['message' => 'Book deleted successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting book'], 500);
        }
    }
}
