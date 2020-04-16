<?php
namespace Apollon\Validation;

use Cake\Validation\Validation;
use Cake\Chronos\Chronos;

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
    public static function zip($check): bool
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
    public static function zip1($check): bool
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
    public static function zip2($check): bool
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
    public static function alpha($check): bool
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
    public static function numeric($check, $limit = 2147483647): bool
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
     * alphaNumericJp
     * 半角英数チェック
     * CoreのalphaNumericは日本語を通過させてしまうため、上書き
     * @access public
     * @author ito
     * @param string $check
     * @return boolean
     */
    public static function alphaNumericJp($check): bool
    {
        $regex = '/^[a-zA-Z0-9]+$/u';
        return (bool) self::_check($check, $regex);
    }

    /**
     * alphaNumericSymbols
     * 半角英数記号チェック
     * 参考URL：http://defindit.com/ascii.html
     * @access public
     * @author ito
     * @param string $check
     * @return boolean
     */
    public static function alphaNumericSymbols($check): bool
    {
        // \x21-\x2f
        // ! " # $ % & ' ( ) * + , - . /
        // \x3a-\x40
        // : ; < = > ? @
        // \x5b-\x60
        // [ \ ] ^ _ `
        // \x7b-\x7e
        // { | } ~
        // 半角スペース、全角スペースは認めない
        $regex = '/^[a-zA-Z0-9\x21-\x2f\x3a-\x40\x5b-\x60\x7b-\x7e]+$/u';
        return (bool) self::_check($check, $regex);
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
    public static function naturalNumber($check, $allowZero = false, $limit = 2147483647): bool
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
    public static function hiraganaOnly($check): bool
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc))*$/';
        return self::_check($check, $regex);
    }

    /**
     * hiraganaSpaceOnly
     * 全角ひらがな以外に全角スペースもOKとするバリデーション
     *
     * @param string $check
     * @return boolean
     */
    public static function hiraganaSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc)|　)*$/';
        return self::_check($check, $regex);
    }

    /**
     * hiraganaAllSpaceOnly
     * 全角ひらがな以外に全半角スペースもOKとするバリデーション
     *
     * @param string $check
     * @return boolean
     */
    public static function hiraganaAllSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc)|\x20|　)*$/';
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
    public static function katakanaOnly($check): bool
    {
        //\xe3\x82\x9b 濁点゛
        //\xe3\x82\x9c 半濁点゜
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c))*$/';
        return self::_check($check, $regex);
    }

    /**
     * katakanaSpaceOnly
     * 全角カタナカ以外に全角スペースもOKとするバリデーション
     *
     * @param string $check
     * @return boolean
     */
    public static function katakanaSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c)|　)*$/';
        return self::_check($check, $regex);
    }

    /**
     * katakanaAllSpaceOnly
     * 全角カタナカ以外に全半角スペースもOKとするバリデーション
     *
     * @param string $check
     * @return boolean
     */
    public static function katakanaAllSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c)|\x20|　)*$/';
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
    public static function zenkakuOnly($check): bool
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
    public static function spaceOnly($check): bool
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
    public static function hankakukatakanaOnly($check): bool
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
    public static function hankakukatakanaSpaceOnly($check): bool
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
    public static function phone($check): bool
    {
        $regex = '/^[0-9]{2,5}-?[0-9]{1,4}-?[0-9]{1,4}$/';
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
    public static function phone1($check): bool
    {
        $regex = '/^[0-9]{2,5}$/';
        return self::_check($check, $regex);
    }

    /**
     * phone2
     * 範囲は1～4桁
     *
     * @access public
     * @author hayasaki
     * @param string $check
     * @return boolean
     */
    public static function phone2($check): bool
    {
        $regex = '/^[0-9]{1,4}$/';
        return self::_check($check, $regex);
    }

    /**
     * phone3
     * 範囲は1～4桁
     *
     * @access public
     * @author hayasaki
     * @param string $check
     * @return boolean
     */
    public static function phone3($check): bool
    {
        $regex = '/^[0-9]{1,4}$/';
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
    public static function emailNonRfc($check): bool
    {
        $regex = '/^[\.a-z0-9!#$%&\'*+\/=?^_`{|}~-]+@' . self::$_pattern['hostname'] . '$/ui';
        return self::_check($check, $regex);
    }

    /**
     * datetimeComparison
     * 日時比較チェック
     *
     * @access public
     * @author fantasista21jp
     * @param $check1
     * @param $operator
     * @param $check2
     * @param $context
     * @return boolean
     */
    public static function datetimeComparison($check1, $operator, $check2, $context): bool
    {
        $date1 = $check1;
        $date2 = $context['data'][$check2];

        if (empty($date1) || empty($date2)) {
            return true;
        }

        if (is_array($date1)) {
            $date1 = static::_getDateString($date1);
        }
        if (is_array($date2)) {
            $date2 = static::_getDateString($date2);
        }

        $parseDate1 = Chronos::parse($date1);
        $parseDate2 = Chronos::parse($date2);

        $operator = str_replace([' ', "\t", "\n", "\r", "\0", "\x0B"], '', strtolower($operator));
        switch ($operator) {
            case 'isgreater':
            case '>':
                return $parseDate1->gt($parseDate2);

            case 'isless':
            case '<':
                return $parseDate1->lt($parseDate2);

            case 'greaterorequal':
            case '>=':
                return $parseDate1->gte($parseDate2);

            case 'lessorequal':
            case '<=':
                return $parseDate1->lte($parseDate2);

            case 'equalto':
            case '==':
                return $parseDate1->eq($parseDate2);

            case 'notequal':
            case '!=':
                return $parseDate1->ne($parseDate2);

            default:
                static::$errors[] = 'You must define the $operator parameter for Validation::datetimeComparison()';
        }

        return false;
    }
}
