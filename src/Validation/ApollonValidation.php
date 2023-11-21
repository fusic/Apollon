<?php
declare(strict_types=1);

namespace Apollon\Validation;

use Cake\Chronos\Chronos;
use Cake\Validation\Validation;

class ApollonValidation extends Validation
{
    /**
     * 郵便番号チェック 1カラム
     *
     * @param mixed $check
     * @return bool
     */
    public static function zip($check): bool
    {
        $regex = '/^[0-9]{3}-?[0-9]{4}$/';

        return self::_check($check, $regex);
    }

    /**
     * 郵便番号チェック 上3桁
     *
     * @param mixed $check
     * @return bool
     */
    public static function zip1($check): bool
    {
        $regex = '/^[0-9]{3}$/';

        return self::_check($check, $regex);
    }

    /**
     * 郵便番号チェック 下4桁
     *
     * @param mixed $check
     * @return bool
     */
    public static function zip2($check): bool
    {
        $regex = '/^[0-9]{4}$/';

        return self::_check($check, $regex);
    }

    /**
     * 半角英字チェック
     *
     * @param mixed $check
     * @return bool
     */
    public static function alpha($check): bool
    {
        $regex = '/^[a-zA-Z]+$/u';

        return self::_check($check, $regex);
    }

    /**
     * 数値チェック
     * integerなどの上限チェックを同時に行う
     *
     * @param mixed $check
     * @param int $limit
     * @return bool
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

        return abs((int)$check) <= $limit;
    }

    /**
     * 半角英数チェック
     * CoreのalphaNumericは日本語を通過させてしまうため、上書き
     *
     * @param mixed $check
     * @return bool
     */
    public static function alphaNumericJp($check): bool
    {
        $regex = '/^[a-zA-Z0-9]+$/u';

        return (bool)self::_check($check, $regex);
    }

    /**
     * 半角英数記号チェック
     *
     * @param mixed $check
     * @return bool
     * @see http://defindit.com/ascii.html
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

        return (bool)self::_check($check, $regex);
    }

    /**
     * 数値チェック
     * integerなどの上限チェックを同時に行う
     *
     * @param mixed $check
     * @param bool $allowZero
     * @param int $limit
     * @return bool
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

        return abs((int)$check) <= $limit;
    }

    /**
     * 全角ひらがな以外が含まれていればエラーとするバリデーションチェック
     * 全角ダッシュ「ー」のみ必要と考えられるので追加
     *
     * @param mixed $check
     * @return bool
     * @see https://github.com/ichikaway/cakeplus
     */
    public static function hiraganaOnly($check): bool
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc))*$/';

        return self::_check($check, $regex);
    }

    /**
     * 全角ひらがな以外に全角スペースもOKとするバリデーション
     *
     * @param mixed $check
     * @return bool
     */
    public static function hiraganaSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc)|　)*$/';

        return self::_check($check, $regex);
    }

    /**
     * 全角ひらがな以外に全半角スペースもOKとするバリデーション
     *
     * @param mixed $check
     * @return bool
     */
    public static function hiraganaAllSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x93]|\x83\xbc)|\x20|　)*$/';

        return self::_check($check, $regex);
    }

    /**
     * 全角カタカナ以外が含まれていればエラーとするバリデーションチェック
     * Japanese KATAKANA Validation
     *
     * @param mixed $check
     * @return bool
     * @see https://github.com/ichikaway/cakeplus
     */
    public static function katakanaOnly($check): bool
    {
        //\xe3\x82\x9b 濁点゛
        //\xe3\x82\x9c 半濁点゜
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c))*$/';

        return self::_check($check, $regex);
    }

    /**
     * 全角カタナカ以外に全角スペースもOKとするバリデーション
     *
     * @param mixed $check
     * @return bool
     */
    public static function katakanaSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c)|　)*$/';

        return self::_check($check, $regex);
    }

    /**
     * 全角カタナカ以外に全半角スペースもOKとするバリデーション
     *
     * @param mixed $check
     * @return bool
     */
    public static function katakanaAllSpaceOnly($check): bool
    {
        $regex = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc|\x82\x9b|\x82\x9c)|\x20|　)*$/';

        return self::_check($check, $regex);
    }

    /**
     * マルチバイト文字以外が含まれていればエラーとするバリデーションチェック
     *
     * @param mixed $check
     * @return bool
     * @see https://github.com/ichikaway/cakeplus
     */
    public static function zenkakuOnly($check): bool
    {
        $regex = '/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/';

        return !self::_check($check, $regex);
    }

    /**
     * 全角、半角スペースのみであればエラーとするバリデーションチェック
     *
     * @param mixed $check
     * @return bool
     * @see https://github.com/ichikaway/cakeplus
     */
    public static function spaceOnly($check): bool
    {
        $regex = '/^(\s|　)+$/';

        return !self::_check($check, $regex);
    }

    /**
     * 半角カタカナ以外が含まれていればエラーとするバリデーションチェック
     *
     * @param mixed $check
     * @return bool
     * @see http://ash.jp/code/unitbl1.htm
     */
    public static function hankakukatakanaOnly($check): bool
    {
        $regex = '/^(?:\xEF\xBD[\xA6-\xBF]|\xEF\xBE[\x80-\x9F])*$/';

        return self::_check($check, $regex);
    }

    /**
     * 半角カタカナ以外にも半角スペースもOKとするバリデーション
     *
     * @param mixed $check
     * @return bool
     * @see http://ash.jp/code/unitbl1.htm
     */
    public static function hankakukatakanaSpaceOnly($check): bool
    {
        $regex = '/^(?:\xEF\xBD[\xA6-\xBF]|\xEF\xBE[\x80-\x9F]|\x20)*$/';

        return self::_check($check, $regex);
    }

    /**
     * 電話番号
     *
     * @param mixed $check
     * @return bool
     */
    public static function phone($check): bool
    {
        $regex = '/^[0-9]{2,5}-?[0-9]{1,4}-?[0-9]{1,4}$/';

        return self::_check($check, $regex);
    }

    /**
     * 市外局番範囲は2～5桁
     *
     * @param mixed $check
     * @return bool
     */
    public static function phone1($check): bool
    {
        $regex = '/^[0-9]{2,5}$/';

        return self::_check($check, $regex);
    }

    /**
     * 範囲は1～4桁
     *
     * @param mixed $check
     * @return bool
     */
    public static function phone2($check): bool
    {
        $regex = '/^[0-9]{1,4}$/';

        return self::_check($check, $regex);
    }

    /**
     * 範囲は1～4桁
     *
     * @param mixed $check
     * @return bool
     */
    public static function phone3($check): bool
    {
        $regex = '/^[0-9]{1,4}$/';

        return self::_check($check, $regex);
    }

    /**
     * メールアドレスチェック（RFC非準拠）
     *
     * @param mixed $check
     * @return bool
     */
    public static function emailNonRfc($check): bool
    {
        $regex = '/^[\.a-z0-9!#$%&\'*+\/=?^_`{|}~-]+@' . self::$_pattern['hostname'] . '$/ui';

        return self::_check($check, $regex);
    }

    /**
     * 日時比較チェック
     *
     * @param mixed $check1
     * @param string $operator
     * @param mixed $check2
     * @param array $context
     * @return bool
     */
    public static function datetimeComparison($check1, string $operator, $check2, array $context): bool
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
                return $parseDate1->greaterThan($parseDate2);

            case 'isless':
            case '<':
                return $parseDate1->lessThan($parseDate2);

            case 'greaterorequal':
            case '>=':
                return $parseDate1->greaterThanOrEquals($parseDate2);

            case 'lessorequal':
            case '<=':
                return $parseDate1->lessthanOrEquals($parseDate2);

            case 'equalto':
            case '==':
                return $parseDate1->equals($parseDate2);

            case 'notequal':
            case '!=':
                return $parseDate1->notEquals($parseDate2);

            default:
                static::$errors[] = 'You must define the $operator parameter for Validation::datetimeComparison()';
        }

        return false;
    }
}
