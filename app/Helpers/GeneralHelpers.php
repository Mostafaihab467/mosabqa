<?php

use App\Enums\Gender;
use App\Models\Lookup;
use App\Models\User;
use App\Models\UserQuestionAnswers;

function getBirthDate($nid)
{
    // nid = 29805180200352
    // get first digit (2)
    $year = substr($nid, 0, 1); // 2
    if ($year == 2) {
        $year = '19'; // 19
    } else {
        $year = '20'; // 20
    }
    // get next 2 digits (98)
    $year = $year . substr($nid, 1, 2); // 98
    // get next 2 digits (05)
    $month = substr($nid, 3, 2); // 05
    // get next 2 digits (18)
    $day = substr($nid, 5, 2); // 18
    return $year . '-' . $month . '-' . $day; // 1998-05-18
}

function getGender($nid)
{
    // nid = 29805180200352
    // get second character from the end (5) and check if it's even or odd
    $gender = substr($nid, -2, 1); // 5
    if ($gender % 2 == 0) {
        return Gender::FEMALE->value;
    } else {
        return Gender::MALE->value;
    }
}

/**
 * @throws Exception
 */
function getAge($birthDate)
{
    $birthDate = new DateTime($birthDate);
    $today = new DateTime('today');
    $age = $birthDate->diff($today)->y;
    return $age;
}


function sites()
{
    return collect([
        [
            'title' => 'English',
            'lang' => 'en',
            'language' => 'English',
            'direction' => 'ltr'
        ],
        [
            'title' => 'Arabic',
            'lang' => 'ar',
            'language' => 'العربية',
            'direction' => 'rtl'
        ]
    ]);
}


function getDgree($userId)
{
    $user = User::query()
        ->where('id', $userId)
        ->first();
    $usersQuestions = UserQuestionAnswers::query()
        ->where('user_id', $userId)
        ->where('category_id', $user->category_id);
    $noUserQuestions = $usersQuestions
        ->count();
    $correctAnswers = $usersQuestions
        ->where('is_correct', 1)
        ->count();

    if ($noUserQuestions != 0) {
        $finalRound = Lookup::where('name', 'final_round')->first()->value;
        if ($finalRound == '1') {
            if ($user->start_final_round)
                $user->grade2 = round((($correctAnswers / $noUserQuestions) * 100), 2);
        } else {
            $user->grade = round((($correctAnswers / $noUserQuestions) * 100), 2);
        }
        $user->save();
        $grade = ($finalRound == '1') ? $user->grade2 : $user->grade;
        if (Auth::user()->roles->first()->name == 'student' && $grade >= Lookup::where('name', 'success_percentage')->first()->value) {
            if ($finalRound == '1') {
                if ($user->start_final_round)
                    $user->serial2 = getSerial();
            } else {
                $user->serial = getSerial();
            }
            $user->save();
        }
    }
    return $noUserQuestions == 0 ? '-' : round((($correctAnswers / $noUserQuestions) * 100), 2);
}

function getSerial()
{
    // check if user has serial
    $user = User::query()
        ->where('id', auth()->id())
        ->first();
    $finalRound = Lookup::where('name', 'final_round')->first()->value;
    if ($finalRound == '1') {
        if ($user->serial2) {
            return $user->serial2;
        }
        // get largest serial
        $serial = User::query()
            ->max('serial2');
    } else {
        if ($user->serial) {
            return $user->serial;
        }
        // get largest serial
        $serial = User::query()
            ->max('serial');
    }
    return $serial + 1;
}
