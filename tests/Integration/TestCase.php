<?php

namespace Crowdsdom\Tests\Integration;

use Crowdsdom\Auth;
use Crowdsdom\Client\Client;
use Crowdsdom\Crowdsdom;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    const ENV_FILE = '.env';
    const ID_KEY = 'CROWDSDOM_ID';
    const SECRET_KEY = 'CROWDSDOM_SECRET';
    const API_KEY = 'CROWDSDOM_API';
    const AUTH_KEY = 'CROWDSDOM_AUTH';

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $apiHost;

    /**
     * @var string
     */
    protected $authHost;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Auth
     */
    protected $auth;

    public function setUp()
    {
        $this->getEnv();
    }

    protected function getAuth()
    {
        return $this->auth = new Auth($this->authHost, $this->clientId, $this->clientSecret);
    }

    protected function getClient()
    {
        if (!isset($this->auth)) {
            $this->auth = $this->getAuth();
        }

        return $this->client = new Client($this->auth, $this->apiHost, Crowdsdom::DEFAULT_API_VERSION, [
            'verify' => false
        ]);
    }

    private function getEnv()
    {
        $this->setEnvFromFile();

        if (!$this->getSettingsFromEnv()) {
            throw new \RuntimeException("Please set CROWDSDOM_ID & CROWDSDOM_SECRET for integration tests");
        }
    }

    private function getSettingsFromEnv()
    {
        $id = getenv(self::ID_KEY);
        $secret = getenv(self::SECRET_KEY);

        if (!$id || !$secret) {
            return false;
        }

        $this->clientId = $id;
        $this->clientSecret = $secret;

        $this->apiHost = getenv(self::API_KEY) ?: Crowdsdom::DEFAULT_API_HOST;
        $this->authHost = getenv(self::AUTH_KEY) ?: Crowdsdom::DEFAULT_AUTH_HOST;

        return true;
    }

    private function setEnvFromFile()
    {
        $credentialsFile = __DIR__ . '/' . self::ENV_FILE;

        if (!file_exists(($credentialsFile))) {
            return false;
        }

        $settings = parse_ini_file($credentialsFile);

        foreach ($settings as $key => $value) {
            putenv("$key=$value");
        }

        return true;
    }
}
