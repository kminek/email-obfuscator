<?php

use Kminek\EmailObfuscator;

if (!function_exists('obfuscate_email')) {
    /**
     * Obfuscate email
     *
     * @param  string $email
     * @param  null|string $text
     * @param  array $options
     * @return string
     */
    function obfuscate_email($email, $text = null, $options = [])
    {
        return EmailObfuscator::obfuscate($email, $text, $options);
    }
}
