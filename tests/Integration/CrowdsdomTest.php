<?php
namespace Crowdsdom\Tests\Integration;

use Crowdsdom\Crowdsdom;

class CrowdsdomTest extends TestCase
{

    public function testLabor()
    {
        $crowdsdom = new Crowdsdom($this->clientId, $this->clientSecret, $this->authHost, $this->apiHost);
        $labor = $crowdsdom->labor();
        $labor->job()->find();
    }

}