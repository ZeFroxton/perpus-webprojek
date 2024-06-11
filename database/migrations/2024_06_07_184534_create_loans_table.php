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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // foreign key ke tabel users
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // foreign key ke tabel books
            $table->date('borrow_date');
            $table->date('return_date');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_returned')->default(false);
            $table->date('actual_return_date')->nullable();
            $table->integer('fine')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
