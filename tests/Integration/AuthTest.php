<?php

namespace Crowdsdom\Tests\Integration;

use Crowdsdom\Auth;
use Crowdsdom\Client\Client;
use Crowdsdom\Crowdsdom;

class AuthTest extends TestCase
{

    /**
     * @var Auth
     */
    protected $auth;

    public function testGetAccessToken()
    {
        $token = $this->auth->getAccessToken();
        $this->assertInternalType('array', $token);
        $this->assertArrayHasKey('access_token', $token);
        $this->assertArrayHasKey('id', $token['access_token']);
        $this->assertArrayHasKey('ttl', $token['access_token']);
        $this->assertArrayHasKey('userId', $token['access_token']);
    }
}
