<?php
namespace App\Exceptions;

use App\Logging\Log;
use App\Session\Session;
use duncan3dc\Laravel\BladeInstance;
use Http\Request;
use Http\Response;

class PageNotFoundException extends \Exception {

    protected $request;
    protected $response;
    protected $session;
    protected $blade;
    protected $logger;

    public function __construct(Request $request, Response $response,
                                Session $session, BladeInstance $blade, Log $logger)
    {
        $this->response = $response;
        $this->request = $request;
        $this->session = $session;
        $this->blade = $blade;
        $this->logger = $logger;
    }

    function handle($page)
    {
        $this->response->setHeader('HTTP/1.1', 404);
        return $this->response->setContent($this->blade->render("generic-page",
            [
                'content' => $page . ' is an unknown page',
                'title' => 'Page Not Found',
            ]));
    }
}
