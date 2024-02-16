<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidNidRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) !== 14) {
            $fail("The $attribute must be 10 characters.");
        }

        // get birth date from nid
        $birthDate = getBirthDate($value);

        // check if birthdate is valid
        if (!$this->isValidDate($birthDate)) {
            $fail("The $attribute is not a valid date.");
        }

        // check if first digit is 1 or 2
        if (!in_array($value[0], ['1', '2'])) {
            $fail("The $attribute must start with 1 or 2.");
        }
    }

    private function isValidDate(string $birthDate)
    {
        if (strtotime($birthDate) === false) {
            return false;
        }
        // check if age is between 7 and 65
        $age = date_diff(date_create($birthDate), date_create('now'))->y;
        if ($age < 7 || $age > 65) {
            return false;
        }
        return true;
    }
}
