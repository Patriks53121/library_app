<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('table_name');
            $table->integer('book_id')->nullable()->constrained('books')->onDelete('cascade');
            $table->integer('loan_id')->nullable()->constrained('loans')->onDelete('cascade');
            $table->integer('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('operation');
            $table->string('old_value')->nullable();
            $table->string('new_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
