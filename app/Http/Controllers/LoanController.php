<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ]);
        if($data['book_id'] == 0) return response()->json(['message' => 'Book is not available'], 400);
        try{
            Loan::create($data);
            return response()->json(['message' => 'Loan created successfully'], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Error creating loan'], 500);
        }

    }

    public function show()
    {
        $loans = Loan::all();
        if($loans==null ||$loans->isEmpty()) return response()->json(['message' => 'No loans found'], 404);
        return response()->json(['message' => 'Loans retrieved successfully', 'loans' => $loans], 201);
    }

    public function showSingle(int $id)
    {
        $loan = Loan::findOrFail($id);
        if($loan==null || $loan->isEmpty()) return response()->json(['message' => 'Loan not found'], 404);
        return response()->json(['message' => 'Loan updated successfully', 'loan' => $loan], 201);
    }

    public function edit(Request $request, Loan $loan)
    {
        $data = $request->validate([
            'book_id' => 'sometimes|exists:books,id',
            'user_id' => 'sometimes|exists:users,id',
            'borrowed_at' => 'sometimes|date',
            'borrowed_due' => 'sometimes|date|after_or_equal:borrowed_at',
            'returned_at' => 'sometimes|date|after_or_equal:borrowed_at',
        ]);

        try {
            $loan->update($data);
            return response()->json(['message' => 'Loan updated successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating loan'], 500);
        }
    }

    public function destroy(Loan $loan)
    {
        try {
            $loan->delete();
            return response()->json(['message' => 'Loan deleted successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting loan'], 500);
        }
    }

    public function returnBook(Loan $loan){
        $loan->update(['returned_at' => now()]);
    }

    public function renewBook(Loan $loan){
        $loan->update(['borrowed_due' => now()->addDays(7)]);
    }

    public function expired_loan(){
        $expired_loans = DB::table('view_expired_loans')->get();
        return response()->json(['message'=> $expired_loans], 201);
    }
}
