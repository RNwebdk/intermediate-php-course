<?php
namespace App\Controllers;

class AuthenticationController extends BaseController
{

    public function showLogin()
    {
        return $this->response->setContent($this->blade->withTemplate("login")->render());
    }


    public function handleLogin()
    {
        $rules = [
            'email'             => 'required|email',
            'password'          => 'required',
        ];

        $errors = $this->validate($rules);

        if (sizeof($errors) > 0) {
            $html = $this->blade
                ->with('session', $this->session)
                ->withTemplate('login')
                ->render();

            $new_html = $this->repopulateForm($html, $errors, $this->request->getParameters());

            return $this->response->setContent($new_html);
        } else {
            return $this->response->setContent('Passed validation!');
        }
    }
}
