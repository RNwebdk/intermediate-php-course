<?php

namespace App\Controllers;


class HomeController extends BaseController {

    public function show()
    {
        $this->response->setContent($this->blade->render("home"));
    }


    public function test()
    {
        $this->response->setContent("This is another method");
    }
}
