<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Models\TestOption;
use App\Models\TestQuestion;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Yajra\DataTables\Facades\DataTables;
use function Laravel\Prompts\info;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch tests with related course, questions, and options
            // $tests = Test::with('course', 'testquestion.testoption')
            //     ->select('id', 'test_title', 'passing_mark', 'total_marks', 'time', 'created_at');
            $test_tbl = test::with('testquestion.testoption')->get();
            return DataTables::of($test_tbl)
                ->addColumn('questions', function ($test) {
                    // Loop through test questions and include their options
                    $questions = $test->testQuestions->map(function ($question) {
                        $questionDetails = $question->question_text . ' (Score: ' . $question->score . ')';

                        // Get options for each question
                        $options = $question->testOptions->map(function ($option) {
                            return $option->option_text . ($option->is_correct ? ' (Correct)' : '');
                        });

                        // Format options below each question
                        $questionDetails .= '<br>' . implode('<br>', $options);
                        return $questionDetails;
                    });

                    return implode('<br><br>', $questions);
                })
                ->addColumn('action', function ($test) {
                    return '<a class="gray-s editTest" data-id="' . $test->id . '">
                            <i class="uil uil-edit"></i>
                        </a>
                        <a class="gray-s deleteTest" data-id="' . $test->id . '">
                            <i class="uil uil-trash"></i>
                        </a>';
                })
                ->rawColumns(['action', 'questions']) // Allow HTML formatting
                ->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role->name == 'admin') {
            return view('admin.course.test');
        } else if (auth()->user()->role->name == 'insructor') {
            return view('instructor.course.test');
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Decode the incoming JSON data
        $data = json_decode($request->getContent(), true);
        Log::error($data);
        try {
            // First, create the test record
            $test = Test::create([
                'course_id' => $data['course_id'],  // Set a static course_id for now
                'test_title' => $data['title'],
                'passing_mark' => $data['passingMark'],
                'total_marks' => $data['totalmarks'],
                'time' => $data['totalTime'],
            ]);

            // Loop through the questions and store them in the test_question table
            foreach ($data['questions'] as $question) {
                //         // Create the question record
                $testQuestion = TestQuestion::create([
                    'test_id' => $test->id,  // Associate with the created test
                    'question_text' => $question['questionText'],
                    'score' => $question['questionScore'],
                ]);

                // Loop through the options for each question and store them in the test_option table
                foreach ($question['options'] as $option) {
                    TestOption::create([
                        'question_id' => $testQuestion->id,  // Associate with the created question
                        'option_text' => $option['text'],
                        'is_correct' => $option['is_correct'],
                    ]);
                }
            }

            //     // If everything is successful, return a success message
            return response()->json(["message" => "Quiz stored successfully"], 200);
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error($data, [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            //     // Return a failure response
            return response()->json(['message' => 'Error saving quiz: ' . $e->getMessage()], 500);
        }

    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request, $quizId)
    {
        //$quiz_id = $request->course_id;
        //Log.info($quiz_id);
        $quiz = test::findOrFail($quizId);// Fetch quiz by ID
        return response()->json($quiz);// Return quiz details as JSON response
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $quizId)
    {
        $request->validate([
            'test_title' => 'required|string|max:255',
            'passing_mark' => 'required|integer',
            'total_marks' => 'required|integer',
            'time' => 'required|string',
        ]);
        //$quiz_id = $request->quiz_id;
        $quiz = test::findOrFail($quizId);
        $quiz->update([
            'course_id' => $request->course_id,  // Set a static course_id for now
            'test_title' => $request->test_title,
            'passing_mark' => $request->passing_mark,
            'total_marks' => $request->total_marks,
            'time' => $request->time,
        ]);
        return response()->json(['success' => 'Quiz updated successfully']);
    }

    public function destroy($id)
    {
        $quiz = test::find($id);

        if ($quiz) {
            $quiz->testquestion()->each(function ($question) {
                // Assuming each question has a 'options' relationship
                $question->testoption()->delete();
            });
            $quiz->testquestion()->delete();
            $quiz->delete();
            return response()->json(['message' => 'Quiz deleted successfully.']);
        } else {
            return response()->json(['message' => 'Quiz not found.'], 404);
        }
    }

}