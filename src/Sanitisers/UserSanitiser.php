<?php

namespace App\Sanitisers;

class UserSanitiser
{
    /**
     * Sanitise as an email.
     *
     * @param string $userEmail string to be sanitised
     *
     * @return string the sanitised email.
     */
    public static function sanitiseEmail(string $userEmail): string
    {
        return filter_var($userEmail, FILTER_SANITIZE_EMAIL);
    }
}
