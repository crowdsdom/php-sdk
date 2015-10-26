<?php

namespace Crowdsdom\Tests;

class Data
{

    public static $allowedModels = ['job', 'task', 'jobType'];

    public static function __callStatic($name, $arguments)
    {
        if (count($arguments) !== 1) {
            throw new \InvalidArgumentException("Must provide 1 argument");
        }

        if (!in_array($name, static::$allowedModels)) {
            throw new \InvalidArgumentException("Must be one of " . implode(",", static::$allowedModels));
        }

        $filepath = __DIR__ . "/data/{$name}/{$arguments[0]}.json";
        if (!file_exists($filepath)) {
            throw new \InvalidArgumentException("File '$filepath' does not exist");
        }

        $content = file_get_contents($filepath);
        $data = json_decode($content, true);
        if ($data === null) {
            throw new \InvalidArgumentException("Provided file is not a valid JSON '$filepath'");
        }

        return $data;
    }

}