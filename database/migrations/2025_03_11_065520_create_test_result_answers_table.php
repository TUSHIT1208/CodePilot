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
        Schema::create('test_result_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_user_id')->references('id')->on('test_results')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('question_id')->references('id')->on('test_questions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('answer_id')->nullable()->constrained('test_options')->onDelete('set null');
            $table->boolean('is_correct')->default(false);
            $table->boolean('is_attempted')->default(false);
            $table->integer('marks')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_result_answers');
    }
};
