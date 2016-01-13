<?php

namespace App\Controllers;

use App\models\Page;
use App\Exceptions\PageNotFoundException;

class PageController extends BaseController {

    public function showHome()
    {
        $this->response->setContent($this->blade->render("home", ['test' => 'abc123']));
    }


    public function showPage($params)
    {
        try {
            $slug = $params['slug'];
            $page = Page::where('slug', '=', $slug)->first();

            if ($page === null)
                throw new PageNotFoundException($page);

            $data['page_content'] = $page->page_content;
            $data['page_title'] = $page->page_title;
            $data['browser_title'] = $page->browser_title;

            $this->response->setContent($this->blade->render("inside-page", $data));
        } catch (PageNotFoundException $e) {
            if ($slug !== 'favicon.ico')
                $this->logWarning("User tried to access page with unknown slug: " . $slug);
            $e->handle($slug);
        }
    }

}
