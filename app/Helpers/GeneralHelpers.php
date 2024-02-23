<?php

use App\Enums\Gender;

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


function sites(){
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
