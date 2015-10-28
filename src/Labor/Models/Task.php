<?php

namespace Crowdsdom\Labor\Models;

class Task extends Base\Task
{
    const ENDPOINT = '/Tasks';

    public function create(array $data)
    {
        throw new \RuntimeException("Not Implemented");
    }

    public function find()
    {
        throw new \RuntimeException("Not Implemented");
    }

    public function findById($id)
    {
        throw new \RuntimeException("Not Implemented");
    }

    public function approve()
    {

    }

    public function reject()
    {

    }

    public function submit()
    {

    }

    public function returns()
    {

    }
}
