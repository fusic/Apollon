<?php

namespace Apollon\Validation;

use Cake\Validation\Validation;

class ApollonValidation extends Validation
{
    public static function zipCheck($value, $context){
        return (bool) preg_match('/^[0-9]{3}-?[0-9]{4}$/', $value);
    }
    
    public static function zip1Check($value, $context){
        return (bool) preg_match('/^[0-9]{3}$/', $value);
    }
    
    public static function zip2Check($value, $context){
        return (bool) preg_match('/^[0-9]{4}$/', $value);
    }
    
}