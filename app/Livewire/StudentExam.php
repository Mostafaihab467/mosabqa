<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Lookup;
use App\Models\Question;
use Livewire\Component;

class StudentExam extends Component
{
    public $timer;
    public $counter = 1;

    public $question_id;
    public $answer_id;

    public function nextQuestion()
    {
        sleep(2);
        $this->counter++;
        if ($this->answer_id != null) {
            $isCorrect = $this->checkAnswer();
        } else {
            $isCorrect = 0;
        }
        \DB::table('user_question_answers')
            ->where('user_id', auth()->id())
            ->where('question_id', $this->question_id)
            ->update([
                'answer_id' => $this->answer_id,
                'is_correct' => $isCorrect,
                'updated_at' => now()
            ]);
        $this->timer = $this->timer = Lookup::where('name', 'question_timer')->first()->value ?? 120;
        $this->dispatch('contentChanged', $this->timer);
    }

    public function decreaseTimer()
    {
        $this->timer--;
        $this->dispatch('contentChanged', $this->timer);
    }

    public function render()
    {
        $userQuestion = \DB::table('user_question_answers')
            ->where('user_id', auth()->id());
        $categoriesFinished = $userQuestion->pluck('category_id')->unique()->toArray();

        $allQuestionCount = $userQuestion->count();
        $noAnsweredQuestionCount = $userQuestion->whereNull('is_correct')->count();
        $this->counter = $allQuestionCount - $noAnsweredQuestionCount + 1;

        $userQuestion = $userQuestion->whereNull('is_correct')->first();

        if ($userQuestion) {
            $question = Question::with('answers')->find($userQuestion->question_id);
            $this->question_id = $question->id;
        } else {
            $question = [];
        }
        $this->timer = Lookup::where('name', 'question_timer')->first()->value ?? 120;

        $msg = '';
        $startExam = true;
        if (!$question && $allQuestionCount) {
            $degree = getDgree(auth()->id());
            if ($degree >= Lookup::where('name', 'success_percentage')->first()->value ?? -1) {
                if (count($categoriesFinished) >= 2) {
                    $msg = "<span class='text-success'>" . __('admin.Congratulations, you have passed the exam with grade') . " " . $degree . "%</span>";
                    $msg .= "</br></br>" . __('admin.Your serial number is') . " " . auth()->user()->serial ?? '-';
                }
            } else {
                if (count($categoriesFinished) >= 2) {
                    $msg = "<span class='text-danger'>" . __('admin.Sorry, you have failed the exam, Your grade is') . " " . $degree . "%</span>";
                }
            }
            if (count($categoriesFinished) >= 2) {
                $msg = __('admin.You have finished your questions') . '</br></br>' . $msg;
            }
            $startExam = false;
        } else if (!$question) {
            $msg = __('admin.You dont have any question');
            $startExam = false;
        } else if (!\App\Models\Lookup::where('name', 'exam_start_date')->where('value', '<=', now())->first()) {
            $msg = __('admin.Exam not started yet');
            $startExam = false;
        } else if (!\App\Models\Lookup::where('name', 'exam_end_date')->where('value', '>=', now())->first()) {
            $msg = __('admin.Exam finished');
            $startExam = false;
        }
        return view('livewire.student-exam', [
            'question' => $question,
            'title' => __('admin.Question') . ' ' . $this->counter,
            'timer' => $this->timer,
            'msg' => $msg ?? '-',
            'startExam' => $startExam
        ]);
    }

    private function checkAnswer()
    {
        $answer = Answer::where('id', $this->answer_id)->where('question_id', $this->question_id)->first();
        if ($answer && $answer->is_correct) {
            $isCorrect = 1;
        } else {
            $isCorrect = 0;
        }
        return $isCorrect;
    }
}
