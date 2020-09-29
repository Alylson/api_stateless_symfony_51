<?php

namespace App\Tests\Validator;

use PHPUnit\Framework\TestCase;
use App\Validator\NotEmptyValidator;

class NotEmptyValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valueProvider
     * @param $name
     * @param $email
     * @param $roles
     * @param $password
     * @param $expectedResult
     */
    public function isValid($name, $email, $roles, $password, $expectedResult)
    {
        $notEmptyValidator = new NotEmptyValidator($name, $email, $roles, $password);

        $isValid = $notEmptyValidator->isValid();

        $this->assertEquals($expectedResult, $isValid);
    }

    public function valueProvider()
    {
        return [
            'shouldBeValidWhenValueIsNotEmpty' => ['name' => 'foo', 'email' => 'foo', 'roles' => 'foo', 'password' => 'foo', 'expectedResult' => true],
            'shouldBeValidWhenValueIsEmpty' => ['name' => '', 'email' => '', 'roles' => '', 'password' => '', 'expectedResult' => false],
        ];
    }
}