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
        Schema::create('test_options', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing 'id' column
            $table->foreignId('question_id')->references('id')->on('test_questions')->onDelete('cascade')->onUpdate('cascade'); // Foreign key constraint to 'test_questions' table
            $table->text('option_text'); // Option text for the question
            $table->boolean('is_correct')->default(false); // Whether the option is correct or not
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_options');
    }
};