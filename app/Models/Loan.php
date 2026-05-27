<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['book_id', 'user_id', 'borrowed_at', 'returned_at'])]
class Loan extends Model
{
    use HasFactory;

    protected $primaryKey = 'loan_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
