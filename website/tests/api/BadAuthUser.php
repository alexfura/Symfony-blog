<?php


namespace App\Tests\api;


use ApiTester;

class BadAuthUser
{
    public function testInvalidToken(ApiTester $I)
    {

        $I->sendGET('/posts/1');
        $I->seeResponseIsJson();
        $I->seeResponseContains('invalid token');
        $I->canSeeResponseCodeIs(401);
    }
}