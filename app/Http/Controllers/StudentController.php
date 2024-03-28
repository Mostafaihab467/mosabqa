<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\UserController;
use App\Models\Category;
use App\Models\Lookup;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\UserQuestionAnswers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function examQuestions(Request $request)
    {
        // user default category
        $categoryId = Auth::user()->category_id;

        $checkIfEligableForFinalRound = Auth::user()->is_success;

        if (Lookup::where('name', 'final_round')->first()->value == '1') {
            if (!$checkIfEligableForFinalRound) {
                return redirect()->back()->with('error', __('admin.You are not eligible for the final round'));
            } else {
                if (Auth::user()->start_final_round == 0) {
                    Auth::user()->update(['start_final_round' => 1]);
                    UserQuestionAnswers::where('user_id', Auth::id())
                        ->delete();
                }
            }
        }
        if ($request->has('category_id')) {
            $categoryId = $request->category_id;
        }
        $questions = [];
        $categoryCategories = \DB::table('category_categories')->where('parent', $categoryId)->get();
        $totalNoOfQuestions = $categoryCategories->sum('no_of_questions');

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
            // unique questions
            $questions = array_unique($questions);
        }
        $userQuestions = UserQuestionAnswers::query()
            ->where('user_id', Auth::id())->first();
        // get all users questions categories
        $userQuestionsCategories = UserQuestionAnswers::query()
            ->where('user_id', Auth::id())
            ->pluck('category_id')->unique()->toArray();
        if (!$userQuestions || ($request->has('category_id') && !in_array($categoryId, $userQuestionsCategories))) {
            foreach ($questions as $question) {
                UserQuestionAnswers::query()->create([
                    'user_id' => Auth::id(),
                    'question_id' => $question,
                    'category_id' => $categoryId,
                    'answer_id' => null,
                    'is_correct' => null,
                ]);
            }
        }
        return view('pages.student.exam-questions');
    }

    public function userAnswers(Request $request)
    {
        if (now() >= Lookup::where('name', 'exam_end_date')->first()->value) {
        return (new UserController())->show(Auth::id());
        }
        abort(403, __('Unauthorized action.'));
    }
}
