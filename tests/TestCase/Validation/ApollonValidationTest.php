<?php
namespace Apollon\Test\TestCase\Validation;

use Cake\TestSuite\TestCase;
use Apollon\Validation\ApollonValidation;

/**
 * Test Case for Validation Class
 *
 */
class ApollonValidationTest extends TestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * test_zip method
     * @dataProvider dataProvider_zip
     * @return void
     */
    public function test_zip($check, $expected)
    {
        $reault = ApollonValidation::zip($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_zip()
    {
        return [
            // 3桁-4桁
            ['810-0001', true],
            ['', false],
            [null, false],
            ['810000',   false],
            ['8100-001', false],
            ['81-00001', false],
            ['a10-000a', false],
            ['810-000a', false],
        ];
    }

    /**
     * test_zip1 method
     * @dataProvider dataProvider_zip1
     * @return void
     */
    public function test_zip1($check, $expected)
    {
        $reault = ApollonValidation::zip1($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_zip1()
    {
        return [
            // 3桁-4桁
            ['810', true],
            ['', false],
            [null, false],
            ['81', false],
            ['8100', false],
            ['8100001', false],
            ['810-0001', false],
            ['81a', false],
        ];
    }

    /**
     * test_zip2 method
     * @dataProvider dataProvider_zip2
     * @return void
     */
    public function test_zip2($check, $expected)
    {
        $reault = ApollonValidation::zip2($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_zip2()
    {
        return [
            // 3桁-4桁
            ['0001', true],
            ['', false],
            [null, false],
            ['810', false],
            ['8100001', false],
            ['810-0001', false],
            ['000a', false],
        ];
    }

    /**
     * test_numeric method
     * @dataProvider dataProvider_numeric
     * @return void
     */
    public function test_numeric($check, $expected)
    {
        $reault = ApollonValidation::numeric($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_numeric()
    {
        return [
            [0, true],
            ['0', true],
            [-0, true],
            ['-0', true],
            [12345, true],
            ['12345', true],
            [-12345, true],
            [-12345, true],
            // limitのチェック
            [2147483647, true],
            ['2147483647', true],
            [-2147483647, true],
            ['-2147483647', true],
            ['', false],
            [null, false],
            // 文字列を含む場合
            ['12345a', false],
            // 16進数
            ['7B', false],
            // 全角数字
            ['０１２３４５６７８９', false],
            ['2147483648', false],
            ['-2147483648', false],
        ];
    }

    /**
     * test_numeric method
     * @dataProvider dataProvider_numeric_limit
     * @return void
     */
    public function test_numeric_limit($check, $limit, $expected)
    {
        $reault = ApollonValidation::numeric($check, $limit);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_numeric_limit()
    {
        return [
            [1000, 1000,  true],
            [-1000, 1000, true],
            [999, 1000,  true],
            [-999, 1000,  true],
            [2147483647, 2147483648, true],
            [-2147483647, 2147483648, true],
            [2147483648, 2147483648, true],
            [-2147483648, 2147483648, true],
            [-2147483648, [], true],
            [-2147483648, ['providers'], true],
            ['a', 1000,  false],
            ['7B', 1000,  false],
            [1, 0,  false],
            [1000, -1000,  false],
        ];
    }

    /**
     * test_alphaNumericJp
     * @dataProvider dataProvider_alphaNumericJp
     * @return void
     */
    public function test_alphaNumericJp($check, $expected)
    {
        $reault = ApollonValidation::alphaNumericJp($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_alphaNumericJp()
    {
        return [
            // 半角英字小文字
            ['abcdefghijklmnopqrstuvwxyz', true],
            // 半角英字大文字
            ['ABCDEFGHIJKLMNOPQRSTUVWXYZ', true],
            // 半角数値(文字列)
            ['0123456789', true],
            // 半角数値(数値)
            [1234567890, true],
            // 半角数値(0)
            [0, true],
            // 半角英字小文字 + 半角英字大文字
            ['abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', true],
            // 半角英字小文字 + 半角英字大文字 + 半角数字
            ['abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890', true],
            ['', false],
            [null, false],
            // 全角英字小文字
            ['ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ', false],
            // 全角英字大文字
            ['ＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺ', false],
            // 全角数値大文字
            ['０１２３４５６７８９', false],
            // 半角数値(マイナス)
            [-1234567890, false],
            // 全角ひらがな
            ['あいうえおかきくけこ', false],
            // 全角カタカナ
            ['アイウエオカキクケコ', false],
            // 半角カタカナ
            ['ｱｲｳｴｵｳﾞ', false],
            // 全角スペース
            ['　', false],
            // 半角スペース
            [' ', false],
            // 記号
            ['!', false],
            ['"', false],
            ['#', false],
            ['$', false],
            ['%', false],
            ['&', false],
            ["'", false],
            ['(', false],
            [')', false],
            ['*', false],
            ['+', false],
            [',', false],
            ['-', false],
            ['.', false],
            ['/', false],
            [':', false],
            [';', false],
            ['<', false],
            ['=', false],
            ['>', false],
            ['?', false],
            ['@', false],
            ['[', false],
            ['\\', false],
            [']', false],
            ['^', false],
            ['_', false],
            ['`', false],
            ['{', false],
            ['|', false],
            ['}', false],
            ['~', false],
        ];
    }

    /**
     * test_alphaNumericSymbols
     * @dataProvider dataProvider_alphaNumericSymbols
     * @return void
     */
    public function test_alphaNumericSymbols($check, $expected)
    {
        $reault = ApollonValidation::alphaNumericSymbols($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_alphaNumericSymbols()
    {
        return [
            // 半角英字小文字
            ['abcdefghijklmnopqrstuvwxyz', true],
            // 半角英字大文字
            ['ABCDEFGHIJKLMNOPQRSTUVWXYZ', true],
            // 半角数値(文字列)
            ['0123456789', true],
            // 半角数値(数値)
            [1234567890, true],
            // 半角数値(0)
            [0, true],
            // 記号
            ['!', true],
            ['"', true],
            ['#', true],
            ['$', true],
            ['%', true],
            ['&', true],
            ["'", true],
            ['(', true],
            [')', true],
            ['*', true],
            ['+', true],
            [',', true],
            ['-', true],
            ['.', true],
            ['/', true],
            [':', true],
            [';', true],
            ['<', true],
            ['=', true],
            ['>', true],
            ['?', true],
            ['@', true],
            ['[', true],
            ['\\', true],
            [']', true],
            ['^', true],
            ['_', true],
            ['`', true],
            ['{', true],
            ['|', true],
            ['}', true],
            ['~', true],
            // 半角英字小文字 + 半角英字大文字
            ['abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', true],
            // 半角英字小文字 + 半角英字大文字 + 半角数字
            ['abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890', true],
            // 半角英字小文字 + 半角英字大文字 + 半角数字 + 記号
            ['abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!"#$%&()*+,-.:;<=>?@[\]^_`{|}~',true],
            ['', false],
            [null, false],
            // 全角英字小文字
            ['ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ', false],
            // 全角英字大文字
            ['ＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺ', false],
            // 全角数値大文字
            ['０１２３４５６７８９', false],
            // 全角ひらがな
            ['あいうえおかきくけこ', false],
            // 全角カタカナ
            ['アイウエオカキクケコ', false],
            // 半角カタカナ
            ['ｱｲｳｴｵｳﾞ', false],
            // 全角スペース
            ['　', false],
            // 半角スペース
            [' ', false],
        ];
    }

    /**
     * test_naturalNumber method
     * @dataProvider dataProvider_naturalNumber
     * @return void
     */
    public function test_naturalNumber($check, $expected)
    {
        $reault = ApollonValidation::naturalNumber($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_naturalNumber()
    {
        return [
            ['1', true],
            ['12345', true],
            ['2147483647', true],
            ['', false],
            [null, false],
            ['0', false],
            ['-1', false],
            ['-1', false],
            ['-2147483647', false],
            ['2147483648', false],
            ['-2147483648', false],
        ];
    }

    /**
     * test_naturalNumber method
     * @dataProvider dataProvider_naturalNumberAllowZero
     * @return void
     */
    public function test_naturalNumberAllowZero($check, $allowZero, $expected)
    {
        $reault = ApollonValidation::naturalNumber($check, $allowZero);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_naturalNumberAllowZero()
    {
        return [
            ['0', true, true],
            ['-0', true, false],
            ['0', false, false],
            ['-0', false, false],
        ];
    }

    /**
     * test_hiraganaOnly method
     * @dataProvider dataProvider_hiraganaOnly
     * @return void
     */
    public function test_hiraganaOnly($check, $expected)
    {
        $reault = ApollonValidation::hiraganaOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_hiraganaOnly()
    {
        return [
            ['', true],
            ['あいうえおー', true],
            ['ー', true],
            [null, false],
            [' ', false],
            ['　', false],
            ['アイウエオー', false],
            ['アイウエオー　', false],
            ['ｱｲｳｴｵｳﾞ', false],
            ['亜伊宇衣於', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['ABCDE', false],
            ['abcde', false],
            ['あいうエオー', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
        ];
    }

    /**
     * test_hiraganaSpaceOnly method
     * @dataProvider dataProvider_hiraganaSpaceOnly
     * @return void
     */
    public function test_hiraganaSpaceOnly($check, $expected)
    {
        $reault = ApollonValidation::hiraganaSpaceOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_hiraganaSpaceOnly()
    {
        return [
            ['', true],
            ['あいうえおー', true],
            ['あいうえおー　', true],
            ['ー', true],
            ['　', true],
            // 半角スペースは認めない
            [' ', false],
            ['あいうえおー ', false],
            ['アイウエオー', false],
            ['アイウエオー　', false],
            ['ｱｲｳｴｵｳﾞ', false],
            ['亜伊宇衣於', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['ABCDE', false],
            ['abcde', false],
            ['あいうエオー', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
        ];
    }

    /**
     * test_hiraganaAllSpaceOnly method
     * @dataProvider dataProvider_hiraganaAllSpaceOnly
     * @return void
     */
    public function test_hiraganaAllSpaceOnly($check, $expected)
    {
        $reault = ApollonValidation::hiraganaAllSpaceOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_hiraganaAllSpaceOnly()
    {
        return [
            ['', true],
            ['あいうえおー', true],
            ['あいうえおー　', true],
            ['ー', true],
            ['　', true],
            // 半角スペースは認める
            [' ', true],
            ['あいうえおー ', true],
            ['アイウエオー', false],
            ['アイウエオー　', false],
            ['ｱｲｳｴｵｳﾞ', false],
            ['亜伊宇衣於', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['ABCDE', false],
            ['abcde', false],
            ['あいうエオー', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
        ];
    }

    /**
     * test_katakanaOnly method
     * @dataProvider dataProvider_katakanaOnly
     * @return void
     */
    public function test_katakanaOnly($check, $expected)
    {
        $reault = ApollonValidation::katakanaOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_katakanaOnly()
    {
        return [
            ['', true],
            ['アイウエオー', true],
            ['ー', true],
            [null, false],
            [' ', false],
            ['　', false],
            ['アイウエオー ', false],
            ['アイウエオー　', false],
            ['あいうえおー', false],
            ['ｱｲｳｴｵｳﾞ', false],
            ['亜伊宇衣於', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['ABCDE', false],
            ['abcde', false],
            ['あいうエオー', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
        ];
    }

    /**
     * test_katakanaOnly method
     * @dataProvider dataProvider_katakanaSpaceOnly
     * @return void
     */
    public function test_katakanaSpaceOnly($check, $expected)
    {
        $reault = ApollonValidation::katakanaSpaceOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_katakanaSpaceOnly()
    {
        return [
            ['', true],
            ['アイウエオー', true],
            ['ー', true],
            ['　', true],
            ['アイウエオー　', true],
            [null, false],
            // 半角スペースは認めない
            [' ', false],
            ['アイウエオー ', false],
            ['あいうえおー', false],
            ['ｱｲｳｴｵｳﾞ', false],
            ['亜伊宇衣於', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['ABCDE', false],
            ['abcde', false],
            ['あいうエオー', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
        ];
    }

    /**
     * test_katakanaAllSpaceOnly method
     * @dataProvider dataProvider_katakanaAllSpaceOnly
     * @return void
     */
    public function test_katakanaAllSpaceOnly($check, $expected)
    {
        $reault = ApollonValidation::katakanaAllSpaceOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_katakanaAllSpaceOnly()
    {
        return [
            ['', true],
            ['アイウエオー', true],
            ['ー', true],
            ['　', true],
            ['アイウエオー　', true],
            // 半角スペースは認める
            [' ', true],
            ['アイウエオー ', true],
            [null, false],
            ['あいうえおー', false],
            ['ｱｲｳｴｵｳﾞ', false],
            ['亜伊宇衣於', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['ABCDE', false],
            ['abcde', false],
            ['あいうエオー', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
        ];
    }

    /**
     * test_zenkakuOnly method
     * @dataProvider dataProvider_zenkakuOnly
     * @return void
     */
    public function test_zenkakuOnly($check, $expected)
    {
        $reault = ApollonValidation::zenkakuOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_zenkakuOnly()
    {
        return [
            ['', true],
            [null, true],
            ['あいうえおー', true],
            ['あいうえおー　', true],
            ['　', true],
            ['アイウエオー', true],
            ['アイウエオー　', true],
            ['あいうエオー', true],
            ['１２３４５６７８９０', true],
            ['ー＾￥「＠：」￥・；', true],
            ['ＡＢＣＤＥ', true],
            ['ａｂｃｄｅ', true],
            ['亜伊宇衣於', true],
            [' ', false],
            ['01234', false],
            ['ABCDE', false],
            ['abcde', false],
            ['ｱｲｳｴｵｳﾞ', false],
        ];
    }

    /**
     * test_spaceOnly method
     * @dataProvider dataProvider_spaceOnly
     * @return void
     */
    public function test_spaceOnly($check, $expected)
    {
        $reault = ApollonValidation::spaceOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_spaceOnly()
    {
        return [
            [' ', false],
            ['　', false],
            ['', true],
            ['a', true],
            ['a ', true],
            [null, true],
        ];
    }

    /**
     * test_hankakukatakanaOnly method
     * @dataProvider dataProvider_hankakukatakanaOnly
     * @return void
     */
    public function test_hankakukatakanaOnly($check, $expected)
    {
        $reault = ApollonValidation::hankakukatakanaOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_hankakukatakanaOnly()
    {
        return [
            ['', true],
            ['ｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜｦﾝｧｨｩｪｫｬｭｮｯｰﾞﾟ', true],
            [null, false],
            [' ', false],
            ['　', false],
            ['ｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜｦﾝｧｨｩｪｫｬｭｮｯｰﾞﾟ｡｢｣､･', false],
            ['アイウエオー', false],
            ['あいうえおー', false],
            ['1234567890', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['亜伊宇衣於', false],
        ];
    }

    /**
     * test_hankakukatakanaSpaceOnly method
     * @dataProvider dataProvider_hankakukatakanaSpaceOnly
     * @return void
     */
    public function test_hankakukatakanaSpaceOnly($check, $expected)
    {
        $reault = ApollonValidation::hankakukatakanaSpaceOnly($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_hankakukatakanaSpaceOnly()
    {
        return [
            ['', true],
            [' ', true],
            ['ｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜｦﾝｧｨｩｪｫｬｭｮｯｰﾞﾟ', true],
            ['ｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜｦﾝｧｨｩｪｫｬｭｮｯｰﾞﾟ ', true],
            [null, false],
            ['　', false],
            ['ｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾀﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾐﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜｦﾝｧｨｩｪｫｬｭｮｯｰﾞﾟ｡｢｣､･', false],
            ['アイウエオー', false],
            ['あいうえおー', false],
            ['1234567890', false],
            ['１２３４５６７８９０', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['亜伊宇衣於', false],
        ];
    }

    /**
     * test_phone method
     * @dataProvider dataProvider_phone
     * @return void
     */
    public function test_phone($check, $expected)
    {
        $reault = ApollonValidation::phone($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_phone()
    {
        return [
            ['12-1234-1234', true],
            ['1212341234', true],
            ['123-1234-1234', true],
            ['12312341234', true],
            ['1234-1234-1234', true],
            ['123412341234', true],
            ['12345-1234-1234', true],
            ['1234512341234', true],
            ['00000-1234-1234', true],
            ['0000012341234', true],
            ['12345-1-1234', true],
            ['1234511234', true],
            ['12345-12-1234', true],
            ['12345121234', true],
            ['12345-123-1234', true],
            ['123451231234', true],
            ['12345-1234-1234', true],
            ['1234512341234', true],
            ['12345-1234', true],
            ['123451234', true],
            ['12-112345', true],
            ['1234-112345', true],
            ['12345-12345', true],
            ['1234512345', true],
            ['112341234', true],
            ['1-112345', false],
            ['1-1234-1234', false],
            ['123456-1234-1234', false],
            ['12345612341234', false],
            ['12345-12345-1234', false],
            ['12345123451234', false],
            ['0120-123-456', true],
            ['１２-３４５６-７８９０', false],
            ['アイウエオー', false],
            ['あいうえおー', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['亜伊宇衣於', false],
            [null, false],
            [' ', false],
            ['　', false],
        ];
    }

    /**
     * test_phone1 method
     * @dataProvider dataProvider_phone1
     * @return void
     */
    public function test_phone1($check, $expected)
    {
        $reault = ApollonValidation::phone1($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_phone1()
    {
        return [
            ['12', true],
            ['123', true],
            ['1234', true],
            ['12345', true],
            ['1', false],
            ['123456', false],
            ['１２-３４５６-７８９０', false],
            ['アイウエオー', false],
            ['あいうえおー', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['亜伊宇衣於', false],
            [null, false],
            [' ', false],
            ['　', false],
        ];
    }

    /**
     * test_phone2 method
     * @dataProvider dataProvider_phone2
     * @return void
     */
    public function test_phone2($check, $expected)
    {
        $reault = ApollonValidation::phone2($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_phone2()
    {
        return [
            ['1', true],
            ['12', true],
            ['123', true],
            ['1234', true],
            ['12345', false],
            ['１２-３４５６-７８９０', false],
            ['アイウエオー', false],
            ['あいうえおー', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['亜伊宇衣於', false],
            [null, false],
            [' ', false],
            ['　', false],
        ];
    }

    /**
     * test_phone3 method
     * @dataProvider dataProvider_phone3
     * @return void
     */
    public function test_phone3($check, $expected)
    {
        $reault = ApollonValidation::phone3($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_phone3()
    {
        return [
            ['1', true],
            ['12', true],
            ['123', true],
            ['1234', true],
            ['12345', false],
            ['１２-３４５６-７８９０', false],
            ['アイウエオー', false],
            ['あいうえおー', false],
            ['ー＾￥「＠：」￥・；', false],
            ['!"#$%&()*+,-.:;<=>?@[\]^_`{|}~', false],
            ['ＡＢＣＤＥ', false],
            ['ａｂｃｄｅ', false],
            ['亜伊宇衣於', false],
            [null, false],
            [' ', false],
            ['　', false],
        ];
    }

    /**
     * test_emailNonRfc method
     * @dataProvider dataProvider_emailNonRfc
     * @return void
     */
    public function test_emailNonRfc($check, $expected)
    {
        $reault = ApollonValidation::emailNonRfc($check);
        $this->assertEquals($reault, $expected);
    }
    public static function dataProvider_emailNonRfc()
    {
        return [
            ['tomonori..shimada@example.jp', true],
            ['tomonori.shimada.@example.jp', true],
            ['tomonori+shimada@example.jp', true],
            ['tomonori.shimada＠example.jp', false],
            ['tomonori@shimada@example.jp', false],
            ['', false],
            [' ', false],
            [null, false],
            ['あtomonori..shimada@example.jp', false],
            ['アtomonori..shimada@example.jp', false],
            [' tomonori..shimada@example.jp', false],
            [' tomonori..shimada@example.AA', false],
        ];
    }

    /**
     * test_datetimeComparison1 method
     * @dataProvider dataProvider_datetimeComparison
     * @return void
     */
    public function test_datetimeComparison1($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 5,
                ],
                'date2' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 5,
                ],
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    /**
     * test_datetimeComparison2 method
     * @dataProvider dataProvider_datetimeComparison
     * @return void
     */
    public function test_datetimeComparison2($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => '2016-8-5',
                'date2' => '2016-8-5',
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    /**
     * test_datetimeComparison3 method
     * @dataProvider dataProvider_datetimeComparison
     * @return void
     */
    public function test_datetimeComparison3($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 5,
                    'hour' => 9,
                    'minute' => 30,
                    'second' => 0,
                ],
                'date2' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 5,
                    'hour' => 9,
                    'minute' => 30,
                    'second' => 0,
                ],
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    /**
     * test_datetimeComparison4 method
     * @dataProvider dataProvider_datetimeComparison
     * @return void
     */
    public function test_datetimeComparison4($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => '2016-8-5 9:30:0',
                'date2' => '2016-8-5 9:30:0',
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    /**
     * test_datetimeComparison5 method
     * @dataProvider dataProvider_datetimeComparisonRevert
     * @return void
     */
    public function test_datetimeComparison5($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 5,
                ],
                'date2' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 6,
                ],
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    /**
     * test_datetimeComparison6 method
     * @dataProvider dataProvider_datetimeComparisonRevert
     * @return void
     */
    public function test_datetimeComparison6($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => '2016-8-5',
                'date2' => '2016-8-6',
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    /**
     * test_datetimeComparison7 method
     * @dataProvider dataProvider_datetimeComparisonRevert
     * @return void
     */
    public function test_datetimeComparison7($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 5,
                    'hour' => 9,
                    'minute' => 30,
                    'second' => 0,
                ],
                'date2' => [
                    'year' => 2016,
                    'month' => 8,
                    'day' => 5,
                    'hour' => 9,
                    'minute' => 30,
                    'second' => 1,
                ],
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    /**
     * test_datetimeComparison8 method
     * @dataProvider dataProvider_datetimeComparisonRevert
     * @return void
     */
    public function test_datetimeComparison8($check, $expected)
    {
        $context = [
            'data' => [
                'date1' => '2016-8-5 9:30:0',
                'date2' => '2016-8-5 9:30:1',
            ],
        ];
        $reault = ApollonValidation::datetimeComparison(
            $context['data']['date1'],
            $check,
            'date2',
            $context
        );
        $this->assertEquals($reault, $expected);
    }

    public static function dataProvider_datetimeComparison()
    {
        return [
            ['greaterorequal', true],
            ['>=',true],
            ['lessorequal', true],
            ['<=',true],
            ['equalto',true],
            ['==',true],
            ['isgreater', false],
            ['<',false],
            ['>',false],
            ['isless', false],
            ['notequal',false],
            ['!=',false],
        ];
    }

    public static function dataProvider_datetimeComparisonRevert()
    {
        return [
            ['greaterorequal', false],
            ['>=',false],
            ['lessorequal', true],
            ['<=',true],
            ['equalto',false],
            ['==',false],
            ['isgreater', false],
            ['<',true],
            ['isless', true],
            ['>',false],
            ['notequal',true],
            ['!=',true],
        ];
    }
}
