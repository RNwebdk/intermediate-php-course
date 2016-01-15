<?php

namespace App\Controllers;

use App\models\Page;
use App\Exceptions\PageNotFoundException;
use Http\Request;
use Http\Response;
use App\Session\Session;
use duncan3dc\Laravel\BladeInstance;
use App\Logging\Log;


/**
 * Class PageController
 * @package App\Controllers
 */
class PageController extends BaseController {

    protected $page;

    /**
     * PageController constructor.
     * @param Request $request
     * @param HttpResponse $response
     * @param Session $session
     * @param BladeInstance $blade
     * @param Log $logger
     * @param Page $page
     */
    public function __construct(Request $request,
                                Response $response,
                                Session $session,
                                BladeInstance $blade,
                                Log $logger,
                                Page $page)
    {
        parent::__construct($request, $response, $session, $blade, $logger);
        $this->page = $page;
    }


    /**
     * @return bool|void
     * @throws PageNotFoundException
     */
    public function showHome()
    {
        $result = $this->getPageBySlug('home');

        if (!$result) {
            throw new PageNotFoundException($result);

            return false;
        } else {
            return $this->response->setContent($this->blade->render("home", $result));
        }

    }


    /**
     * @param $params
     * @return PageNotFoundException|bool|\Exception|void
     */
    public function showPage($params)
    {
        try {
            $slug = $params['slug'];
            $result = $this->getPageBySlug($slug);

            if (!$result) {
                throw new PageNotFoundException($result);

                return false;
            } else {
                return $this->response->setContent($this->blade->render("inside-page", $result));
            }

        } catch (PageNotFoundException $e) {
            if ($slug !== 'favicon.ico')
                $this->logWarning("User tried to access page with unknown slug: " . $slug);
            $e->handle($slug);

            return $e;
        }
    }


    /**
     * @param $slug
     * @return array|bool
     */
    protected function getPageBySlug($slug)
    {
        $result = $this->page->where('slug', '=', $slug)->first();

        if ($result !== null) {
            return [
                'page_title'    => $result->page_title,
                'page_content'  => $result->page_content,
                'browser_title' => $result->browser_title,
            ];
        } else {
            return false;
        }
    }

}
