<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        try {
            User::create($data);
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating user'], 500);
        }
    }
    public function edit(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8',
        ]);

        try {
            $user->update($data);
            return response()->json(['message' => 'User updated successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating user'], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user'], 500);
        }
    }

    public function loanBook(Request $request, Book $book, User $user){
        $requestData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ]);
        if($book->available == 0) return response()->json(['message' => 'Book is not available'], 400);
        try{
            DB::transaction(function() use ($data){
                if($book->available > 0){
                    Loan::create([
                        'book_id' => $book->id,
                        'user_id' => $user->id,
                        'borrowed_at' => now(),
                    ]);
                    $book->decrement('available');
                    return response()->json(['message' => 'Book loaned successfully'], 201);
                }
                return response()->json(['message' => 'Book is not available'], 400);});
        } catch (\Exception $e) {
                return response()->json(['message' => 'Error loaning book'], 500);
            }
    }
}

