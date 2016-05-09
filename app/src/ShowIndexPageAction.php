<?php

namespace App;

/**
 * Class ShowIndexPageAction
 * @author yourname
 */
class ShowIndexPageAction
{
    public function __construct($log)
    {
        $this->log = $log;
    }

    public function __invoke()
    {
        $this->log->info("hello");
        return "hello";
    }
}
