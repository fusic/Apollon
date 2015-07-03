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
     * testNotEmpty method
     *
     * @return void
     */
    public function test_zipCheck()
    {
        $this->assertTrue(ApollonValidation::zipCheck('810-0001',[]));
        $this->assertTrue(ApollonValidation::zipCheck('8100001',[]));
        $this->assertFalse(ApollonValidation::zipCheck('810000',[]));
        $this->assertFalse(ApollonValidation::zipCheck('8100-001',[]));
        $this->assertFalse(ApollonValidation::zipCheck('810-000a',[]));
    }

    /**
     * testNotEmpty method
     *
     * @return void
     */
    public function test_zip1Check()
    {
        $this->assertTrue(ApollonValidation::zip1Check('810',[]));
        $this->assertFalse(ApollonValidation::zip1Check('8100001',[]));
        $this->assertFalse(ApollonValidation::zip1Check('810-0001',[]));
        $this->assertFalse(ApollonValidation::zip1Check('81a',[]));
    }

    /**
     * testNotEmpty method
     *
     * @return void
     */
    public function test_zip2Check()
    {
        $this->assertTrue(ApollonValidation::zip2Check('0001',[]));
        $this->assertFalse(ApollonValidation::zip2Check('8100001',[]));
        $this->assertFalse(ApollonValidation::zip2Check('810-0001',[]));
        $this->assertFalse(ApollonValidation::zip2Check('000a',[]));
    }

}
