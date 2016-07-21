<?php
namespace Apollon\Validation;

use Cake\Validation\Validation;

class ApollonValidation extends Validation
{
    /**
     *  zip
     * 郵便番号チェック 1カラム
     *
     * @access public
     * @author hagiwara
     * @param string $check
     * @return boolean
     */
    public static function zip($check)
    {
        $regex = '/^[0-9]{3}-?[0-9]{4}$/';
        return self::_check($check, $regex);
    }

    /**
     * zip1
     * 郵便番号チェック 上3桁
     *
     * @access public
     * @author hagiwara
     * @param string $check
     * @return boolean
     */
    public static function zip1($check)
    {
        $regex = '/^[0-9]{3}$/';
        return self::_check($check, $regex);
    }

    /**
     * zip2
     * 郵便番号チェック 下4桁
     *
     * @access public
     * @author hagiwara
     * @param string $check
     * @return boolean
     */
    public static function zip2($check)
    {
        $regex = '/^[0-9]{4}$/';
        return self::_check($check, $regex);
    }

    /**
     * 半角英字チェック
     *
     * @access public
     * @author sakuragawa
     * @param string $check
     * @return boolean
     */
    public static function alpha($check)
    {
        $regex = '/^[a-zA-Z]+$/u';
        return self::_check($check, $regex);
    }

    /**
     * numeric
     * 数値チェック
     * integerなどの上限チェックを同時に行う
     *
     * @access public
     * @author hagiwara
     * @param string $check
     * @param integer $limit
     * @return boolean
     */
    public static function numeric($check, $limit = 2147483647)
    {
        //providersが間違いなく$contextの内容と考えられるので初期値を入力しなおす
        if (is_array($limit) && isset($limit['providers'])) {
            $limit = 2147483647;
        }

        //coreのチェックを先に行う
        if (!parent::numeric($check)) {
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
     * @param string $check
     * @param boolean $allowZero
     * @param integer $limit
     * @return boolean
     */
    public static function naturalNumber($check, $allowZero = false, $limit = 2147483647)
    {
        //providersが間違いなく$contextの内容と考えられるので初期値を入力しなおす
        if (is_array($allowZero) && isset($allowZero['providers'])) {
            $allowZero = false;
        }
        if (is_array($limit) && isset($limit['providers'])) {
            $limit = 2147483647;
        }

        //coreのチェックを先に行う
        if (!parent::naturalNumber($check, $allowZero)) {
            return false;
        }
        return abs($check) <= $limit;
    }

    /**
     * hiraganaOnly
     * 全角ひらがな以外が含まれていればエラーとするバリデーションチェック
     * 全角ダッシュ「ー」のみ必要と考えられるので追加
     * Japanese HIRAGANA Validation
     * @param string $check
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public static function hiraganaOnly($check)
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc))*$/';
        return self::_check($check, $regex);
    }

    /**
     * hiraganaSpaceOnly
     * 全角ひらがな以外にスペースもOKとするバリデーション
     *
     * @param string $check
     * @return boolean
     */
    public static function hiraganaSpaceOnly($check)
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc)|　)*$/';
        return self::_check($check, $regex);
    }

    /**
     * katakanaOnly
     * 全角カタカナ以外が含まれていればエラーとするバリデーションチェック
     * Japanese KATAKANA Validation
     *
     * @param string $check
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public static function katakanaOnly($check)
    {
        //\xe3\x82\x9b 濁点゛
        //\xe3\x82\x9c 半濁点゜
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c))*$/';
        return self::_check($check, $regex);
    }

    /**
     * katakanaSpaceOnly
     * 全角カタナカ以外にスペースもOKとするバリデーション
     *
     * @param string $check
     * @return boolean
     */
    public static function katakanaSpaceOnly($check)
    {
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c)|　)*$/';
        return self::_check($check, $regex);
    }

    /**
     * zenkakuOnly
     * マルチバイト文字以外が含まれていればエラーとするバリデーションチェック
     * Japanese ZENKAKU Validation
     *
     * @param string $check
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public static function zenkakuOnly($check)
    {
        $regex = '/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/';
        return !self::_check($check, $regex);
    }

    /**
     * spaceOnly
     * 全角、半角スペースのみであればエラーとするバリデーションチェック
     * Japanese Space only validation
     *
     * @param string $check
     * @return boolean
     * https://github.com/ichikaway/cakeplus
     */
    public static function spaceOnly($check)
    {
        $regex = '/^(\s|　)+$/';
        return !self::_check($check, $regex);
    }

    /**
     * hankakukatakanaOnly
     * 半角カタカナ以外が含まれていればエラーとするバリデーションチェック
     * Japanese HANKAKU KATAKANA Validation
     * http://ash.jp/code/unitbl1.htm
     * @param string $check
     * @return boolean
     */
    public static function hankakukatakanaOnly($check)
    {
        $regex = '/^(?:\xEF\xBD[\xA6-\xBF]|\xEF\xBE[\x80-\x9F])*$/';
        return self::_check($check, $regex);
    }

    /**
     * hankakukatakanaSpaceOnly
     * 半角カタカナ以外にも半角スペースもOKとするバリデーション
     * Japanese HANKAKU KATAKANA SPACE Validation
     * http://ash.jp/code/unitbl1.htm
     * @param string $check
     * @return boolean
     */
    public static function hankakukatakanaSpaceOnly($check)
    {
        $regex = '/^(?:\xEF\xBD[\xA6-\xBF]|\xEF\xBE[\x80-\x9F]|\x20)*$/';
        return self::_check($check, $regex);
    }

    /**
     * phone
     *
     * @access public
     * @author hayasaki
     * @param string $check
     * @return boolean
     */
    public static function phone($check)
    {
        $regex = '/^[0-9]{2,5}-?[0-9]{2,4}-?[0-9]{4}$/';
        return self::_check($check, $regex);
    }

    /**
     * phone1
     * 市外局番範囲は2～5桁
     *
     * @access public
     * @author hayasaki
     * @param string $check
     * @return boolean
     */
    public static function phone1($check)
    {
        $regex = '/^[0-9]{2,5}$/';
        return self::_check($check, $regex);
    }

    /**
     * phone2
     * 範囲は2～4桁
     *
     * @access public
     * @author hayasaki
     * @param string $check
     * @return boolean
     */
    public static function phone2($check)
    {
        $regex = '/^[0-9]{2,4}$/';
        return self::_check($check, $regex);
    }

    /**
     * phone3
     * 範囲は4桁固定
     *
     * @access public
     * @author hayasaki
     * @param string $check
     * @return boolean
     */
    public static function phone3($check)
    {
        $regex = '/^[0-9]{4}$/';
        return self::_check($check, $regex);
    }


    /**
     * emailNonRfc
     * メールアドレスチェック（RFC非準拠）
     *
     * @access public
     * @author fantasista21jp
     * @param string $check
     * @return boolean
     */
    public static function emailNonRfc($check)
    {
        $regex = '/^[\.a-z0-9!#$%&\'*+\/=?^_`{|}~-]+@' . self::$_pattern['hostname'] . '$/ui';
        return self::_check($check, $regex);
    }
}
