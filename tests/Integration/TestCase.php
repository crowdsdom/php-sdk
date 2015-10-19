<?php

namespace Crowdsdom\Tests\Integration;

use Crowdsdom\Client\Client;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    const CREDENTIALS_FILE = __DIR__ . '/.env';
    const ID_KEY = 'CROWDSDOM_ID';
    const SECRET_KEY = 'CROWDSDOM_SECRET';

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->getCredentials();
        $this->getClient();
    }

    private function getClient()
    {
        $this->client = new Client($this->clientId, $this->clientSecret);
    }

    private function getCredentials()
    {
        if (!$this->getCredentialsFromEnv() && !$this->getCredentialsFromFile()) {
            throw new \RuntimeException("Please set CROWDSDOM_ID & CROWDSDOM_SECRET for integration tests");
        }
    }

    private function getCredentialsFromEnv()
    {
        $id = getenv(self::ID_KEY);
        $secret = getenv(self::SECRET_KEY);

        if (!$id || !$secret) {
            return false;
        }

        $this->clientId = $id;
        $this->clientSecret = $secret;

        return true;
    }

    private function getCredentialsFromFile()
    {
        if (!file_exists((self::CREDENTIALS_FILE))) {
            return false;
        }

        $settings = parse_ini_file(self::CREDENTIALS_FILE);

        if (!isset($settings[self::ID_KEY]) || !isset($settings[self::SECRET_KEY])) {
            return false;
        }

        $this->clientId = $settings[self::ID_KEY];
        $this->clientSecret = $settings[self::SECRET_KEY];

        return true;
    }
}
