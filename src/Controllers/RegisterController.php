<?php
namespace App\Controllers;

use App\Exceptions\UserExistsException;
use App\models\Registration;
use App\models\User;

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
            'first_name'       => 'required|min:3',
            'last_name'        => 'required|min:3',
            'email'            => 'unique:User:email|required|email',
            'confirm-email'    => 'required|email|equalTo:email',
            'agree'            => 'required',
            'password'         => 'required|min:3',
            'confirm-password' => 'required|equalTo:password',
            'join_list'        => 'required',
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
            $user = new User();
            $user->email = $this->request->getParameter('email');
            $user->password = password_hash($this->request->getParameter('password'), PASSWORD_DEFAULT);
            $user->save();

            $user_id = $user->id;

            $registration = new Registration();
            $registration->user_id = $user_id;
            $registration->first_name = $this->request->getParameter('first_name');
            $registration->last_name = $this->request->getParameter('last_name');
            $registration->colour = $this->request->getParameter('colour');
            $registration->comments = $this->request->getParameter('comments');
            $registration->join_list = $this->request->getParameter('join_list');
            $registration->save();

            return $this->response->setContent($this->blade->render("generic-page",
                [
                    'content' => 'Thanks for joining our site!',
                    'title'   => 'Thanks!',
                ]));
        }
    }

}
