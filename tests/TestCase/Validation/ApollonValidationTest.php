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
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * test_zipCheck method
     *
     * @return void
     */
    public function test_zipCheck()
    {
        $this->assertTrue(ApollonValidation::zipCheck('810-0001'));
        $this->assertTrue(ApollonValidation::zipCheck('8100001'));
        $this->assertFalse(ApollonValidation::zipCheck('810000'));
        $this->assertFalse(ApollonValidation::zipCheck('8100-001'));
        $this->assertFalse(ApollonValidation::zipCheck('810-000a'));
    }

    /**
     * test_zip1Check method
     *
     * @return void
     */
    public function test_zip1Check()
    {
        $this->assertTrue(ApollonValidation::zip1Check('810'));
        $this->assertFalse(ApollonValidation::zip1Check('8100001'));
        $this->assertFalse(ApollonValidation::zip1Check('810-0001'));
        $this->assertFalse(ApollonValidation::zip1Check('81a'));
    }

    /**
     * test_zip2Check method
     *
     * @return void
     */
    public function test_zip2Check()
    {
        $this->assertTrue(ApollonValidation::zip2Check('0001'));
        $this->assertFalse(ApollonValidation::zip2Check('8100001'));
        $this->assertFalse(ApollonValidation::zip2Check('810-0001'));
        $this->assertFalse(ApollonValidation::zip2Check('000a'));
    }

    /**
     * test_numericCheck method
     *
     * @return void
     */
    public function test_numericCheck()
    {
        $this->assertTrue(ApollonValidation::numericCheck('12345'));
        $this->assertTrue(ApollonValidation::numericCheck('2147483647'));
        $this->assertTrue(ApollonValidation::numericCheck('-2147483647'));
        $this->assertFalse(ApollonValidation::numericCheck('2147483648'));
        $this->assertFalse(ApollonValidation::numericCheck('-2147483648'));
        $this->assertTrue(ApollonValidation::numericCheck('12345', '20000'));
        $this->assertFalse(ApollonValidation::numericCheck('12345', '12344'));
    }

    /**
     * test_numericCheck method
     *
     * @return void
     */
    public function test_naturalNumber()
    {
        $this->assertTrue(ApollonValidation::naturalNumber('12345'));
        $this->assertTrue(ApollonValidation::naturalNumber('2147483647'));
        $this->assertFalse(ApollonValidation::naturalNumber('-2147483647'));
        $this->assertFalse(ApollonValidation::naturalNumber('2147483648'));
        $this->assertFalse(ApollonValidation::naturalNumber('-2147483648'));
        $this->assertTrue(ApollonValidation::naturalNumber('12345', false, '20000'));
        $this->assertFalse(ApollonValidation::naturalNumber('12345', false, '12344'));
    }

    /**
     * test_maxLengthJP method
     *
     * @return void
     */
    public function test_maxLengthJP()
    {
        $this->assertTrue(ApollonValidation::maxLengthJP('aaa', 3));
        $this->assertFalse(ApollonValidation::maxLengthJP('aaaa', 3));
        $this->assertTrue(ApollonValidation::maxLengthJP('あああ', 3));
        $this->assertFalse(ApollonValidation::maxLengthJP('ああああ', 3));
        $this->assertTrue(ApollonValidation::maxLengthJP('ああa', 3));
        $this->assertFalse(ApollonValidation::maxLengthJP('ああaあ', 3));
        $this->assertFalse(ApollonValidation::maxLengthJP('あaaあ', 3));
    }

    /**
     * test_maxLengthJP method
     *
     * @return void
     */
    public function test_minLengthJP()
    {
        $this->assertFalse(ApollonValidation::minLengthJP('aaa', 4));
        $this->assertTrue(ApollonValidation::minLengthJP('aaaa', 4));
        $this->assertFalse(ApollonValidation::minLengthJP('あああ', 4));
        $this->assertTrue(ApollonValidation::minLengthJP('ああああ', 4));
        $this->assertFalse(ApollonValidation::minLengthJP('ああa', 4));
        $this->assertTrue(ApollonValidation::minLengthJP('ああaあ', 4));
        $this->assertTrue(ApollonValidation::minLengthJP('あaaあ', 4));
    }

    /**
     * test_betweenJP method
     *
     * @return void
     */
    public function test_betweenJP()
    {
        $this->assertTrue(ApollonValidation::betweenJP('aaa', 2, 4));
        $this->assertFalse(ApollonValidation::betweenJP('aaaaa', 2, 4));
        $this->assertTrue(ApollonValidation::betweenJP('あああ', 2, 4));
        $this->assertFalse(ApollonValidation::betweenJP('あああああ', 2, 4));
        $this->assertTrue(ApollonValidation::betweenJP('ああa', 2, 4));
        $this->assertFalse(ApollonValidation::betweenJP('ああaあa', 2, 4));
        $this->assertFalse(ApollonValidation::betweenJP('あaaあa', 2, 4));
    }

    /**
     * test_hiraganaOnly method
     *
     * @return void
     */
    public function test_hiraganaOnly()
    {
        $this->assertTrue(ApollonValidation::hiraganaOnly('あいうえおー'));
        $this->assertFalse(ApollonValidation::hiraganaOnly('あいうえおー　'));
        $this->assertFalse(ApollonValidation::hiraganaOnly('aiueo'));
        $this->assertFalse(ApollonValidation::hiraganaOnly('アイウエオー'));
        $this->assertFalse(ApollonValidation::hiraganaOnly('アイウエオー　'));
        $this->assertFalse(ApollonValidation::hiraganaOnly('あいうエオー'));
        $this->assertFalse(ApollonValidation::hiraganaOnly('１２３４５６７８９０'));
        $this->assertFalse(ApollonValidation::hiraganaOnly('ー＾￥「＠：」￥・；'));
    }

    /**
     * test_hiraganaSpaceOnly method
     *
     * @return void
     */
    public function test_hiraganaSpaceOnly()
    {
        $this->assertTrue(ApollonValidation::hiraganaSpaceOnly('あいうえおー'));
        $this->assertTrue(ApollonValidation::hiraganaSpaceOnly('あいうえおー　'));
        $this->assertFalse(ApollonValidation::hiraganaSpaceOnly('aiueo'));
        $this->assertFalse(ApollonValidation::hiraganaSpaceOnly('アイウエオー'));
        $this->assertFalse(ApollonValidation::hiraganaSpaceOnly('アイウエオー　'));
        $this->assertFalse(ApollonValidation::hiraganaSpaceOnly('あいうエオー'));
        $this->assertFalse(ApollonValidation::hiraganaSpaceOnly('１２３４５６７８９０'));
        $this->assertFalse(ApollonValidation::hiraganaSpaceOnly('ー＾￥「＠：」￥・；'));
    }

    /**
     * test_katakanaOnly method
     *
     * @return void
     */
    public function test_katakanaOnly()
    {
        $this->assertFalse(ApollonValidation::katakanaOnly('あいうえおー'));
        $this->assertFalse(ApollonValidation::katakanaOnly('あいうえおー　'));
        $this->assertFalse(ApollonValidation::katakanaOnly('aiueo'));
        $this->assertTrue(ApollonValidation::katakanaOnly('アイウエオー'));
        $this->assertFalse(ApollonValidation::katakanaOnly('アイウエオー　'));
        $this->assertFalse(ApollonValidation::katakanaOnly('あいうエオー'));
        $this->assertFalse(ApollonValidation::katakanaOnly('１２３４５６７８９０'));
        $this->assertFalse(ApollonValidation::katakanaOnly('ー＾￥「＠：」￥・；'));
    }

    /**
     * test_katakanaSpaceOnly method
     *
     * @return void
     */
    public function test_katakanaSpaceOnly()
    {
        $this->assertFalse(ApollonValidation::katakanaSpaceOnly('あいうえおー'));
        $this->assertFalse(ApollonValidation::katakanaSpaceOnly('あいうえおー　'));
        $this->assertFalse(ApollonValidation::katakanaSpaceOnly('aiueo'));
        $this->assertTrue(ApollonValidation::katakanaSpaceOnly('アイウエオー'));
        $this->assertTrue(ApollonValidation::katakanaSpaceOnly('アイウエオー　'));
        $this->assertFalse(ApollonValidation::katakanaSpaceOnly('あいうエオー'));
        $this->assertFalse(ApollonValidation::katakanaSpaceOnly('１２３４５６７８９０'));
        $this->assertFalse(ApollonValidation::katakanaSpaceOnly('ー＾￥「＠：」￥・；'));
    }

    /**
     * test_zenkakuOnly method
     *
     * @return void
     */
    public function test_zenkakuOnly()
    {
        $this->assertTrue(ApollonValidation::zenkakuOnly('あいうえおー'));
        $this->assertTrue(ApollonValidation::zenkakuOnly('あいうえおー　'));
        $this->assertFalse(ApollonValidation::zenkakuOnly('aiueo'));
        $this->assertTrue(ApollonValidation::zenkakuOnly('アイウエオー'));
        $this->assertTrue(ApollonValidation::zenkakuOnly('アイウエオー　'));
        $this->assertTrue(ApollonValidation::zenkakuOnly('あいうエオー'));
        $this->assertTrue(ApollonValidation::zenkakuOnly('１２３４５６７８９０'));
        $this->assertTrue(ApollonValidation::zenkakuOnly('ー＾￥「＠：」￥・；'));
    }

    /**
     * test_spaceOnly method
     *
     * @return void
     */
    public function test_spaceOnly()
    {
        $this->assertFalse(ApollonValidation::spaceOnly('　'));
        $this->assertFalse(ApollonValidation::spaceOnly(' '));
        $this->assertTrue(ApollonValidation::spaceOnly('a '));
        $this->assertTrue(ApollonValidation::spaceOnly('a　'));
    }

}
