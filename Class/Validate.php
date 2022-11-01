<?php

namespace kitchen;

class Validate
{
    public static function validate_string($str) : string {
        return trim(stripslashes(htmlspecialchars($str)));
    }
}