<?php
namespace App\Controllers;

class AdminController extends BaseController {

    public function showSecret()
    {
        return $this->response->setContent($this->blade->render("generic-page",
            [
                'content' => 'This is a protected page!',
                'title'   => 'Super Secret',
            ]));
    }
}
