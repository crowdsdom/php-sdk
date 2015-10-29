<?php
namespace Crowdsdom\Tests\Integration;

use Crowdsdom\Labor;

class LaborTest extends TestCase
{

    public function testJob()
    {
        $labor = new Labor($this->getClient());
        $job = $labor->job();
        $job->find();
    }
}