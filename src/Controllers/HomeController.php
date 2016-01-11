<?php

namespace App\Controllers;


use App\models\Page;

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
}
