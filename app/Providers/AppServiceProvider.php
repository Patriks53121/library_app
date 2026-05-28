<?php

namespace App\Providers;

//use App\Models\Book;
//use App\Models\Loan;
//use App\Models\User;
//use App\Observers\GlobalDatabaseObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // uncomment it to log from code
//        Book::observe(GlobalDatabaseObserver::class);
//        Loan::observe(GlobalDatabaseObserver::class);
//        User::observe(GlobalDatabaseObserver::class);
    }
}
