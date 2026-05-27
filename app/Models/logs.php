<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['table_name', 'column_name', 'book_id', 'loan_id', 'user_id', 'operation', 'old_value', 'new_value'])]
class logs extends Model
{
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
