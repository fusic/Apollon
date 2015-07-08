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
    public static function zipCheck($check)
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
    public static function zip1Check($check)
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
    public static function zip2Check($check)
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
    public static function alpha($check)
    {
        $regex = '/^[a-zA-Z]+$/u';
        return self::_check($check, $regex);
    }
    
    /**
     * numericCheck
     * 数値チェック
     * integerなどの上限チェックを同時に行う
     *
     * @access public
     * @author hagiwara
     */
    public static function numericCheck($check, $limit = 2147483647)
    {
        //providersが間違いなく$contextの内容と考えられるので初期値を入力しなおす
        if (is_array($limit) && isset($limit['providers'])){
            $limit = 2147483647;
        }
        
        //coreのチェックを先に行う
        if (!parent::numeric($check)){
            return false;
        }
        return abs($check) <= $limit;
    }
    
    /**
     * naturalNumber
     * 数値チェック
     * integerなどの上限チェックを同時に行う
     *
     * @access public
     * @author hagiwara
     */
    public static function naturalNumber($check, $allowZero = false, $limit = 2147483647)
    {
        //providersが間違いなく$contextの内容と考えられるので初期値を入力しなおす
        if (is_array($allowZero) && isset($allowZero['providers'])){
            $allowZero = false;
        }
        if (is_array($limit) && isset($limit['providers'])){
            $limit = 2147483647;
        }
        
        //coreのチェックを先に行う
        if (!parent::naturalNumber($check, $allowZero)){
            return false;
        }
        return abs($check) <= $limit;
    }
}

