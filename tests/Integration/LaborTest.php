<?php
namespace Crowdsdom\Tests\Integration;

use Crowdsdom\Labor;

class LaborTest extends TestCase
{

    public function testJob()
    {
        $labor = new Labor($this->getClient());
        $labor->job();
    }

    public function testTask()
    {
        $labor = new Labor($this->getClient());
        $labor->task();
    }

    public function testJobType()
    {
        $labor = new Labor($this->getClient());
        $labor->jobType();
    }
}