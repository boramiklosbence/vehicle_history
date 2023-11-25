<?php

namespace App\Http\Traits;

trait CommonTrait {

    /**
     * Transform the registration number to the format AAA-123.
     */
    function transformRegistrationNumber($inputString) {
        if (preg_match('/^([a-zA-Z]{3})-?(\d{3})$/i', $inputString, $matches)) {
            return strtoupper($matches[1]) . '-' . $matches[2];
        } else {
            return $inputString;
        }
    }
    
}