<?php
namespace App\Controllers;

use App\Models\User;
use Plasticbrain\FlashMessages\FlashMessages;

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

            // try logging in
            $okay = true;
            $email = $this->request->getParameter('email');
            $password = $this->request->getParameter('password');

            //look up the user
            $user = User::where('email', '=', $email)
                ->first();

            if ($user != null) {
                // validate credentials
                if (! password_verify($password, $user->password)) {
                    $okay = false;
                }
            } else {
                $okay = false;
            }

            if ($okay) {
                $this->session->put('user', $user);
                return $this->response->redirect("/");
            } else {
                $this->session->put('errorMsg', 'Invalid Login!');
                $flash = new FlashMessages();
                $flash->error('Invalid Login');
                $template = $this->blade->with('flash', $flash)->withTemplate("login")->render();

                return $this->response->setContent($template);
            }
        }
    }


    public function logout()
    {
        $this->session->forget('user');
        $this->response->redirect('/login');
    }
}
