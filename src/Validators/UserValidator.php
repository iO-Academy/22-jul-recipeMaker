<?php

namespace App\Validators;

class UserValidator
{
        /**
     * Sanitise the applicant's email from the applicant's data.
     *
     * @param string $email
     *
     * @return string $email, returns valid email.
     * @return bool, returns false if invalid email.
     */
    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
