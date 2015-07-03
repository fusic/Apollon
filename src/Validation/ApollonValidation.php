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
    public static function zipCheck($check, $context)
    {
        $regex = '/^[0-9]{3}-?[0-9]{4}$/';
        return self::_check($check, $regex);
    }
    
    /**
     * zip1Check
     * 郵便番号チェック 上3桁
     *
     * @access public
     * @author hagiwara
     */
    public static function zip1Check($check, $context)
    {
        $regex = '/^[0-9]{3}$/';
        return self::_check($check, $regex);
    }
    
    /**
     * zip2Check
     * 郵便番号チェック 下4桁
     *
     * @access public
     * @author hagiwara
     */
    public static function zip2Check($check, $context)
    {
        $regex = '/^[0-9]{4}$/';
        return self::_check($check, $regex);
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

