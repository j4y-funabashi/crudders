<?php

namespace App;

/**
 * Class ShowIndexPageAction
 * @author yourname
 */
class ShowIndexPageAction
{
    public function __construct(
        $view,
        $log
    ) {
        $this->log = $log;
        $this->view = $view;
    }

    public function __invoke()
    {
        $this->log->info("hello");
        return $this->view->render(
            "index.html",
            array()
        );
    }
}
