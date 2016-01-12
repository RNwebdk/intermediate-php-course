<?php

namespace App\Controllers;

use App\Logging\Log;
use App\Session\Session;
use duncan3dc\Laravel\BladeInstance;
use Http\HttpRequest;
use Http\HttpResponse;

class BaseController {

    protected $request;
    protected $response;
    protected $session;
    protected $blade;
    protected $logger;

    public function __construct(HttpRequest $request, HttpResponse $response,
                                Session $session, BladeInstance $blade, Log $logger)
    {
        $this->response = $response;
        $this->request = $request;
        $this->session = $session;
        $this->blade = $blade;
        $this->logger = $logger;
    }


    public function logInfo($entry)
    {
        $this->logger->logInfo($entry);
    }


    public function logWarning($entry)
    {
        $this->logger->logWarning($entry);
    }


    public function logError($entry)
    {
        $this->logger->logError($entry);
    }

}
