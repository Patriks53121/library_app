<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['table_name', 'book_id', 'loan_id', 'user_id', 'operation', 'old_value', 'new_value', 'created_at', 'updated_at'])]
class Log extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'log_id';
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
