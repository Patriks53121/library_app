<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['title', 'ISBN', 'available'])]
class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
