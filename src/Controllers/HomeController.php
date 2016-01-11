<?php

namespace App\Controllers;

use App\Session\Session;
use Http\HttpRequest;
use Http\HttpResponse;

class HomeController {

    private $request;
    private $response;
    private $session;

    public function __construct(HttpRequest $request, HttpResponse $response, Session $session)
    {
        $this->response = $response;
        $this->request = $request;
        $this->session = $session;
    }

    public function show()
    {
        $this->response->setContent("Returned from controller");
    }


    public function test()
    {
        $this->response->setContent("This is another method");
    }
}
