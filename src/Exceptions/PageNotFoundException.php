<?php
namespace App\Exceptions;

class PageNotFoundException extends \Exception {

    function handle($page)
    {
        echo 'Error on line ' . $this->getLine()
            . ' in '
            . $this->getFile()
            . ': <br>' . $page . ' is an unknown page';
        die();
    }
}
