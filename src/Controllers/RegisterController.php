<?php
namespace App\Controllers;

/**
 * Class RegisterController
 * @package App\Controllers
 */
class RegisterController extends BaseController
{

    /**
     * @return mixed
     */
    public function showRegister()
    {
        return $this->response->setContent($this->blade->withTemplate("register")->render());
    }


    /**
     * @return mixed
     */
    public function handleRegister()
    {
        $rules = [
            'first_name'        => 'required|min:3',
            'last_name'         => 'required|min:3',
            'email'             => 'required|email',
            'confirm-email'     => 'required|email|equalTo:email',
            'agree'             => 'required',
            'password'          => 'required|min:3',
            'confirm-password'  => 'required|equalTo:password',
            'join_mailing_list' => 'required',
        ];

        $errors = $this->validate($rules);

        if (sizeof($errors) > 0) {
            $html = $this->blade
                ->with('session', $this->session)
                ->withTemplate('register')
                ->render();

            $new_html = $this->repopulateForm($html, $errors, $this->request->getParameters());

            return $this->response->setContent($new_html);
        } else {
            return $this->response->setContent('Passed validation!');
        }
    }

}
