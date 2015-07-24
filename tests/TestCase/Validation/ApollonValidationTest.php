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
     * test_zip method
     *
     * @return void
     */
    public function test_zip()
    {
        $this->assertTrue(ApollonValidation::zip('810-0001'));
        $this->assertTrue(ApollonValidation::zip('8100001'));
        $this->assertFalse(ApollonValidation::zip('810000'));
        $this->assertFalse(ApollonValidation::zip('8100-001'));
        $this->assertFalse(ApollonValidation::zip('810-000a'));
    }

    /**
     * test_zip1 method
     *
     * @return void
     */
    public function test_zip1()
    {
        $this->assertTrue(ApollonValidation::zip1('810'));
        $this->assertFalse(ApollonValidation::zip1('8100001'));
        $this->assertFalse(ApollonValidation::zip1('810-0001'));
        $this->assertFalse(ApollonValidation::zip1('81a'));
    }

    /**
     * test_zip2 method
     *
     * @return void
     */
    public function test_zip2()
    {
        $this->assertTrue(ApollonValidation::zip2('0001'));
        $this->assertFalse(ApollonValidation::zip2('8100001'));
        $this->assertFalse(ApollonValidation::zip2('810-0001'));
        $this->assertFalse(ApollonValidation::zip2('000a'));
    }

    /**
     * test_numeric method
     *
     * @return void
     */
    public function test_numeric()
    {
        $this->assertTrue(ApollonValidation::numeric('12345'));
        $this->assertTrue(ApollonValidation::numeric('2147483647'));
        $this->assertTrue(ApollonValidation::numeric('-2147483647'));
        $this->assertFalse(ApollonValidation::numeric('2147483648'));
        $this->assertFalse(ApollonValidation::numeric('-2147483648'));
        $this->assertTrue(ApollonValidation::numeric('12345', '20000'));
        $this->assertFalse(ApollonValidation::numeric('12345', '12344'));
    }

    /**
     * test_naturalNumber method
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
