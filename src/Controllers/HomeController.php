<?php

namespace App\Controllers;

use App\models\Page;
use App\Logging\Log;

class HomeController extends BaseController {

    public function show()
    {
        $this->response->setContent($this->blade->render("home", ['test' => 'abc123']));
    }


    public function test()
    {
        $this->response->setContent("This is another method");
    }


    public function testPage()
    {
        $page = Page::find(1);
        $content = $page->page_content;
        $this->response->setContent($content);
    }

    public function testPageAndLog()
    {
        $page = Page::find(1);
        $content = $page->page_content;
        $this->response->setContent($content);
        $this->logError('test entry');
    }

    public function testSession()
    {
        if ($this->session->has('savedValue')) {
            $this->response->setContent("Value in session is " . $this->session->get('savedValue'));
        } else {
            $this->session->put('savedValue', 'My Value');
            $this->response->setContent("No value in session!");
        }
    }

}
