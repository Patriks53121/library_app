<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Log;

use App\Observers\GlobalDatabaseObserver;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Book::observe(GlobalDatabaseObserver::class);
        Loan::observe(GlobalDatabaseObserver::class);
        User::observe(GlobalDatabaseObserver::class);

        DB::listen(function (QueryExecuted $query) {
            if (str_contains(strtolower($query->sql), 'select')) {
                preg_match('/from\s+["`]?(\w+)["`]?/i', $query->sql, $matches);
                $table = $matches[1] ?? 'unknown';

                if (in_array($table, ['books', 'loans', 'users'])) {
                    Log::create([
                        'table_name' => $table,
                        'operation' => $query->sql,
                        'old_value' => null,
                        'new_value' => null,
                    ]);
                }
            }
        });
    }

}
