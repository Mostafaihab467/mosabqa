<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Console\Command;

class AddDevQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'questions:add-dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add questions with related answers from dev_questions and dev_answers tables to questions and answers tables.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $devQuestions = \DB::table('dev_questions')->get();
        foreach ($devQuestions as $devQuestion) {
            $question = Question::create([
                'question' => $devQuestion->question,
                'name' => $devQuestion->name,
                'category_id' => $devQuestion->category_id,
            ]);
            $devAnswers = \DB::table('dev_answers')->where('question_id', $devQuestion->id)->get();
            foreach ($devAnswers as $devAnswer) {
                Answer::create([
                    'answer' => $devAnswer->answer,
                    'question_id' => $question->id,
                    'is_correct' => $devAnswer->is_correct,
                ]);
            }
        }
    }
}
