<?php 

class AuthUserCest
{
    private $token;

    public function _before(ApiTester $I)
    {
        $I->sendPOST('/login', [
            'email' => 'furgaylov5@gmail.com',
            'password' => 'qwertyqwerty']
        );
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'token' => 'string'
        ]);
        $this->token = $I->grabDataFromResponseByJsonPath('token')[0];
        codecept_debug($this->token);
        $I->seeResponseCodeIsSuccessful();
    }

    public function testResource(ApiTester $I)
    {
        $I->haveHttpHeader('Authorization', 'Bearer '. $this->token);
        $I->sendGET('/posts/1');
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'title' => 'string',
            'textField' => 'string',
            'topic' => 'integer',
            'author' => 'integer'
        ]);
        $I->seeResponseCodeIsSuccessful();
    }

    public function testNotExistedResource(ApiTester $I)
    {
        $I->haveHttpHeader('Authorization', 'Bearer '. $this->token);
        $I->sendGET('/posts/100');
        $I->seeResponseIsJson();
        $I->seeResponseContains('error');
        $I->canSeeResponseCodeIs(404);
    }
}
