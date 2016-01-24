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


    public function showDashboard()
    {
        return $this->response->setContent($this->blade->render("admin.dashboard"));
    }
}
