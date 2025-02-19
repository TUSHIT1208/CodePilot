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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->default(0)->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');  
            $table->foreignId('admin_id')->default(0)->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');  
            $table->foreignId('course_id')->default(1)->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');  
            $table->string('video_title');
            $table->text('description')->nullable();
            $table->text('video_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
