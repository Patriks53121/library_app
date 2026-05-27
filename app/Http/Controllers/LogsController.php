<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogsController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
            'table_name' => 'required|string|max:255',
            'column_name' => 'required|string|max:255',
            'book_id' => 'nullable|integer|exists:books,book_id',
            'loan_id' => 'nullable|integer|exists:loans,loan_id',
            'user_id' => 'nullable|integer|exists:users,user_id',
            'operation' => 'required|string|max:255',
            'old_value' => 'nullable|string|max:255',
            'new_value' => 'nullable|string|max:255',
        ]);
        try {
            Log::create($data);
            return response()->json(['message' => 'Log created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating log'], 500);
        }
    }

    public function show()
    {
        $logs = Logs::all();
        if($logs==null ||$logs->isEmpty()) return response()->json(['message' => 'No logs found'], 404);
        return response()->json(['message' => 'Logs retrieved successfully', 'logs' => $logs], 201);
    }

}
