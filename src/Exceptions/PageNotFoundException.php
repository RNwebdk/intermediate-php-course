<?php
namespace App\Exceptions;

use App\Logging\Log;
use App\Session\Session;
use App\Renderers\BladeRenderer;
use Http\Request;
use Http\Response;

/**
 * Class PageNotFoundException
 * @package App\Exceptions
 */
class PageNotFoundException extends \Exception
{

    protected $request;
    protected $response;
    protected $session;
    protected $blade;
    protected $logger;

    /**
     * PageNotFoundException constructor.
     * @param Request $request
     * @param Response $response
     * @param Session $session
     * @param BladeRenderer $blade
     * @param Log $logger
     */
    public function __construct(Request $request, Response $response,
                                Session $session, BladeRenderer $blade, Log $logger)
    {
        $this->response = $response;
        $this->request = $request;
        $this->session = $session;
        $this->blade = $blade;
        $this->logger = $logger;
    }

    /**
     * @param $page
     * @return mixed
     */
    function handle($page)
    {
        $this->response->setHeader('HTTP/1.1', 404);

        return $this->response->setContent($this->blade->with('session', $this->session)->render("generic-page",
            [
                'content' => $page . ' is an unknown page',
                'title'   => 'Page Not Found',
            ]));
    }
}
