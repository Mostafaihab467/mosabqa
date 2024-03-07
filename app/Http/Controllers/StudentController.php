<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function examQuestions(Request $request)
    {
        // get random questions from database
        $categoryId = Auth::user()->category_id;
        $questions = [];
        $categoryCategories = \DB::table('category_categories')->where('parent', $categoryId)->get();
        $totalNoOfQuestions = $categoryCategories->sum('no_of_questions');
//        return $totalNoOfQuestions;

        // get questions should be added to the exam
        $getQuestions = QuestionCategory::where('category_id', $categoryId)->pluck('question_id');

        // add to questions array
        foreach ($getQuestions as $getQuestion) {
            // if questions array is greater than or equal to total number of questions, break the loop
            if (count($questions) >= $totalNoOfQuestions) {
                break;
            }
            $questions[] = $getQuestion;
        }

        foreach ($categoryCategories as $key => $categoryCategory) {
            $noOfQuestions = $totalNoOfQuestions - count($questions);
            $currentCategory = $categoryCategory->child;
            $minTake = min($noOfQuestions, $categoryCategory->no_of_questions);
            $getQuestions = Question::where('category_id', $currentCategory)
                ->whereNotIn('id', $questions)
                ->inRandomOrder()
                ->limit($minTake)
                ->pluck('id');

            // add to questions array
            foreach ($getQuestions as $getQuestion) {
                // if questions array is greater than or equal to total number of questions, break the loop
                if (count($questions) >= $totalNoOfQuestions) {
                    break;
                }
                $questions[] = $getQuestion;
            }
        }
        $userQuestions = \DB::table('user_question_answers')
            ->where('user_id', Auth::id())->first();
        if (!$userQuestions) {
            foreach ($questions as $question) {
                \DB::table('user_question_answers')->insert([
                    'user_id' => Auth::id(),
                    'question_id' => $question,
                    'answer_id' => null,
                    'is_correct' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        return view('pages.student.exam-questions');
    }
}
