<?php

/**
 * Functions for validating user input.
 */
class Validator
{
    public static function checkPassword($pwd)
    {
        return preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/", $pwd);
    }
}

?>