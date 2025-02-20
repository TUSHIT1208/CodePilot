<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_questions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('test_id')->references('id')->on('tests')->onDelete('cascade')->onUpdate('cascade'); // Foreign key referencing the 'tests' table
            $table->string('question_text'); // The question text field
            $table->decimal('score', 8, 2); // Decimal score field with a maximum of 8 digits and 2 decimal places
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_questions');
    }
};