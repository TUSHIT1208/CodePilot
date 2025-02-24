<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Models\TestOption;
use App\Models\TestQuestion;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.test');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Decode the incoming JSON data
        $data = json_decode($request->getContent(), true);

        // Access specific variables from the decoded array
        $test_title = $data['test'];
        $passing_mark = $data['passing'];
        $time = $data['time'];
        $questions = $data['questions'];  // This will contain the array of questions

        try {
            // First, create the test record
            $test = Test::create([
                'course_id' => $data['course_id'],  // Set a static course_id for now
                'test_title' => $test_title,
                'passing_mark' => $passing_mark,
                'time' => $time,
            ]);

            // Loop through the questions and store them in the test_question table
            foreach ($questions as $question) {
                // Create the question record
                $testQuestion = TestQuestion::create([
                    'test_id' => $test->id,  // Associate with the created test
                    'question_text' => $question['name'],
                    'score' => $question['score'],
                ]);

                // Loop through the options for each question and store them in the test_option table
                foreach ($question['options'] as $option) {
                    TestOption::create([
                        'question_id' => $testQuestion->id,  // Associate with the created question
                        'option_text' => $option['value'],
                        'is_correct' => $option['is_correct'],
                    ]);
                }
            }

            // If everything is successful, return a success message
            return response()->json(["message" => "Quiz stored successfully"], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Error inserting quiz data', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return a failure response
            return response()->json(['message' => 'Error saving quiz: ' . $e->getMessage()], 500);
        }

        // $quiz = new Test();
        // $quiz->course_id = 1; // Replace this with actual course ID if needed
        // $quiz->test_title = $test_title;
        // $quiz->passing_mark = $passing_mark;
        // $quiz->time = $time;
        // $quiz->save();
        // return response()->json(["message" => "Quiz stored successfully"], 200);

        // // Validate the incoming data
        // $validated = \Validator::make($data, [
        //     'test_title' => 'required|string|max:255',
        //     'passing_mark' => 'required|integer',
        //     'time' => 'required|date_format:H:i:s', // Ensure the time is in a valid format
        // ]);

        // // Check if validation fails
        // if ($validated->fails()) {
        //     return response()->json([
        //         'message' => 'Validation failed',
        //         'errors' => $validated->errors()
        //     ], 422);
        // }

        // try {
        //     // Store the quiz details in the database
        //     $quiz = new Test();
        //     $quiz->course_id = 1; // Replace this with actual course ID if needed
        //     $quiz->test_title = $data['test_title'];
        //     $quiz->passing_mark = $data['passing_mark'];
        //     $quiz->time = $data['time'];
        //     $quiz->save(); // Save the quiz record in the database

        //     return response()->json(["message" => "Quiz stored successfully"], 200);

        // } catch (\Exception $e) {
        //     // Handle any errors that occur while saving
        //     return response()->json(['message' => 'Error saving quiz: ' . $e->getMessage()], 500);
        // }
    }


    /**
     * Display the specified resource.
     */
    public function show(test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(test $test)
    {
        //
    }
}