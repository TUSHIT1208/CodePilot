<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use Carbon\Carbon;

class FaqSeeder extends Seeder
{

    public function run()
    {
        // Insert dummy data using the Faq model
        Faq::insert([
            [
                'question' => 'What is Laravel?',
                'answer' => 'Laravel is a PHP framework that helps developers build modern web applications. It is known for its elegant syntax, scalability, and a rich set of features.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How do I install Laravel?',
                'answer' => 'You can install Laravel using Composer by running the following command: composer create-project --prefer-dist laravel/laravel your-project-name.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'What is Eloquent ORM?',
                'answer' => 'Eloquent is Laravel\'s built-in ORM (Object-Relational Mapping) for interacting with databases. It allows you to work with your database tables as if they were simple PHP objects.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How can I migrate the database?',
                'answer' => 'You can migrate the database using the following Artisan command: php artisan migrate. This will run all the pending migrations and create the necessary database tables.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'What is middleware in Laravel?',
                'answer' => 'Middleware provides a convenient mechanism for filtering HTTP requests entering your application. For example, you might want to check if the user is authenticated before accessing certain pages.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How do I use validation in Laravel?',
                'answer' => 'You can validate data in Laravel using the validate method on the request. For example: request()->validate([\'email\' => \'required|email\']);',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'What is Artisan in Laravel?',
                'answer' => 'Artisan is the command-line interface included with Laravel. It provides a number of helpful commands for common tasks such as database migrations, running tests, and more.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}