<?php

namespace App\Controllers;

use App\Session\Session;
use duncan3dc\Laravel\BladeInstance;
use Http\HttpRequest;
use Http\HttpResponse;

class BaseController {

    protected $request;
    protected $response;
    protected $session;
    protected $blade;

    public function __construct(HttpRequest $request, HttpResponse $response, Session $session, BladeInstance $blade)
    {
        $this->response = $response;
        $this->request = $request;
        $this->session = $session;
        $this->blade = $blade;
    }

}
