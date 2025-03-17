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
                'question' => 'How to create a course?',
                'answer' => 'In the dashboard, click on "Course" and then select "Create New Course." Fill in the basic details, test, media, price, and then publish the course.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How to purchase a course?',
                'answer' => 'Go to the student dashboard, select a course, and click on "Add to Cart." Then, click on the "Checkout" button, complete the payment, and the course will be added to your profile.',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How to get a certificate?',
                'answer' => 'First, you need to complete all the videos in the course. Then, take the course test. If you pass the test, you will receive a certificate.',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How to take a test?',
                'answer' => 'Go to your profile, select the course, click on "Test," and then click on "Start Certification" to begin the test.',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How to watch videos and run code?',
                'answer' => 'First, you need to purchase the course. Once purchased, the course content will be displayed. Click on the video to watch it and access the code to run it.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How to use the free course?',
                'answer' => 'You just need to register on our website to access the free course.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How to interact with us?',
                'answer' => 'Visit our "Contact Us" page, fill out the form, and submit it. Our team will get in touch with you shortly.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
