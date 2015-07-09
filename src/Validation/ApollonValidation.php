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
    
    /**
     * hiraganaOnly
     * 全角ひらがな以外が含まれていればエラーとするバリデーションチェック
     * 全角ダッシュ「ー」のみ必要と考えられるので追加
     * Japanese HIRAGANA Validation
     * @param array &$model
     * @param array $wordvalue
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public function hiraganaOnly($check)
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc))*$/';
        return self::_check($check, $regex);
    }
    
    /**
     * hiraganaSpaceOnly
     * 全角ひらがな以外にスペースもOKとするバリデーション
     */
    public function hiraganaSpaceOnly($check)
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc)|　)*$/';
        return self::_check($check, $regex);
    }
    
    /**
     * katakanaOnly
     * 全角カタカナ以外が含まれていればエラーとするバリデーションチェック
     * Japanese KATAKANA Validation
     *
     * @param array &$model
     * @param array $wordvalue
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public function katakanaOnly($check)
    {
        //\xe3\x82\x9b 濁点゛
        //\xe3\x82\x9c 半濁点゜
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c))*$/';
        return self::_check($check, $regex);
    }
    
    /**
     * katakanaSpaceOnly
     * 全角カタナカ以外にスペースもOKとするバリデーション
     */
    public function katakanaSpaceOnly($check)
    {
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c)|　)*$/';
        return self::_check($check, $regex);
    }
    
    /**
     * zenkakuOnly
     * マルチバイト文字以外が含まれていればエラーとするバリデーションチェック
     * Japanese ZENKAKU Validation
     *
     * @param array &$model
     * @param array $wordvalue
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public function zenkakuOnly($check)
    {
        $regex = '/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/';
        return !self::_check($check, $regex);
    }
    
    /**
     * spaceOnly
     * 全角、半角スペースのみであればエラーとするバリデーションチェック
     * Japanese Space only validation
     *
     * @param array &$model
     * @param array $wordvalue
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public function spaceOnly($check)
    {
        $regex = '/^(\s|　)+$/';
        return !self::_check($check, $regex);
    }
}

