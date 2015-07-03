<?php
namespace Apollon\Validation;

use Cake\Validation\Validation;

class ApollonValidation extends Validation
{
    /**
     *  zipCheck
     * 郵便番号チェック 1カラム
     *
     * @access public
     * @author hagiwara
     */
    public static function zipCheck($value, $context)
    {
        return (bool) preg_match('/^[0-9]{3}-?[0-9]{4}$/', $value);
    }
    
    /**
     * zip1Check
     * 郵便番号チェック 上3桁
     *
     * @access public
     * @author hagiwara
     */
    public static function zip1Check($value, $context)
    {
        return (bool) preg_match('/^[0-9]{3}$/', $value);
    }
    
    /**
     * zip2Check
     * 郵便番号チェック 下4桁
     *
     * @access public
     * @author hagiwara
     */
    public static function zip2Check($value, $context)
    {
        return (bool) preg_match('/^[0-9]{4}$/', $value);
    }

    /**
     * 半角英字チェック
     *
     * @access public
     * @author sakuragawa
     */
    public static function alpha($check, $context)
    {
        $regex = '/^[a-zA-Z]+$/u';
        return self::_check($check, $regex);
    }
}

