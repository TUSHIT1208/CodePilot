<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\test;
use App\Models\test_result;
use App\Models\TestQuestion;
use Illuminate\Http\Request;
use App\Models\test_result_answer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TestResultController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function submitTest(Request $request, $testId)
    {
        $userId = auth()->id();
        $course = session('course');
        $test_id = test::where('course_id', $course)->first();
        $p_marks = $test_id->passing_mark;
        $totalCorrect = 0;
        $totalWrong = 0;
        $totalAttempted = 0;
        $overallScore = 0;

        DB::beginTransaction();

        try {
            $startTime = session('test_start_time');
            if (!$startTime) {
                throw new \Exception('Test start time not found in session.');
            }

            $timeSpend = now()->diffInSeconds($startTime);

            $testResult = test_result::create([
                'test_id' => $testId,
                'user_id' => $userId,
                'overall_score' => 0,
                'time_spend' => $timeSpend,
                'total_wrong_answer' => 0,
                'total_correct_answer' => 0,
                'total_attempted' => 0
            ]);

            $answers = $request->input('answers', []);
            if (empty($answers)) {
                throw new \Exception('No answers submitted.');
            }

            foreach ($answers as $questionId => $answerId) {
                $question = TestQuestion::find($questionId);

                if (!$question) {
                    Log::error("Question not found: $questionId");
                    continue;
                }

                $isCorrect = $question->testoption()->where('id', $answerId)->where('is_correct', true)->exists();

                $totalAttempted++;
                if ($isCorrect) {
                    $totalCorrect++;
                    $overallScore += $question->score;
                } else {
                    $totalWrong++;
                }

                $test_answer = test_result_answer::create([
                    'test_user_id' => $testResult->id,
                    'question_id' => $questionId,
                    'answer_id' => $answerId,
                    'is_correct' => $isCorrect,
                    'is_attempted' => true,
                    'marks' => $isCorrect ? $question->score : 0
                ]);
            }

            $testResult->update([
                'overall_score' => $overallScore,
                'total_wrong_answer' => $totalWrong,
                'total_correct_answer' => $totalCorrect,
                'total_attempted' => $totalAttempted
            ]);

            DB::commit();
            $certificate = certificate::all()->last();
            $test_result = test_result::all()->last();
            //$course = session('course');
            // $test_id = test::where('course_id', $course)->first();
            // $p_marks = $test_id->passing_mark;
            $test_answer = session(['test_answer_id' => $test_answer->test_user_id]);



            // $course = session('course');
            // $test = test::where('course_id', $course)->first();
            // $test_result = test_result::where('test_id', $testId)->first();
            if ($test_id->passing_marks < $test_result->overall_score) {
                $certificate = Certificate::create([
                    'user_id' => Auth::user()->id,
                    'test_id' => $test_id->id,
                    'name' => Auth()->user()->first_name,
                    'email' => Auth()->user()->email,
                    'phone_no' => Auth()->user()->phone_number,
                ]);
            }

            //$test_result = session(['test_result_id' => $test_result->id]);

            return view(
                "learner.course.certificate.genrate",
                compact('certificate', 'test_result', 'p_marks')
            );
            // return view('learner.course.certificate.test', compact('p_marks', 'test'))->with('success', 'Test submitted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Test Submission Error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function show(test_result $test_result)
    {
        //
    }

    public function edit(test_result $test_result)
    {
        //
    }

    public function update(Request $request, test_result $test_result)
    {
        //
    }

    public function destroy(test_result $test_result)
    {
        //
    }

    // public function result()
    // {
    //     $userId = Auth::id();

    //     $results = test_result_answer::whereHas('testResult', function ($query) use ($userId) {
    //         $query->where('user_id', $userId);
    //     })
    //         ->selectRaw('
    //     SUM(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) AS total_right_answers,
    //     SUM(CASE WHEN is_correct = 0 THEN 1 ELSE 0 END) AS total_wrong_answers
    // ')
    //         ->first();

    //     return view('learner.course.certificate.result', [
    //         'total_right_answers' => $results->total_right_answers,
    //         'total_wrong_answers' => $results->total_wrong_answers
    //     ]);
    // }
}