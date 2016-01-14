<?php
namespace App\Controllers;

class RegisterController extends BaseController {

    public function showRegister()
    {
        return $this->response->setContent($this->blade->render("register"));
    }


    public function handleRegister()
    {
        $first_name = $this->request->getParameter('first_name');
        $parameters = $this->request->getParameters();

        return $this->response->setContent("Hello, " . $first_name);
    }
}
