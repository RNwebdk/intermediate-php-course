<?php
namespace App\Controllers;

use Symfony\Component\DomCrawler\Crawler;
use Sunra\PhpSimple\HtmlDomParser;

class RegisterController extends BaseController {

    public function showRegister()
    {
        return $this->response->setContent($this->blade->render("register"));
    }


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
            $html = $this->blade->render("register", ['session' => $this->session]);
            $new_html = $this->repopulateForm($html, $errors, $this->request->getParameters());

            return $this->response->setContent($new_html);
        }
    }


    public function repopulateForm($html, $errors, $paramters, $div = "error", $css = "alert alert-danger")
    {
        $dom = HtmlDomParser::str_get_html($html);

        // repopulate form
        foreach ($paramters as $name => $value) {

            // first do inputs
            $elements = $dom->find('input[name=' . $name . ']');
            foreach ($elements as $element) {
                $tag = $element->tag;
                switch ($tag) {
                    case ("input"):
                        switch ($element->type) {
                            case ("radio"):
                                $element->checked = $element->value == $value ? true : null;
                                break;
                            case ("checkbox"):
                                $element->checked = true;
                                break;
                            case ("select"):
                                break;
                            case ("text"):
                                $element->value = $value;
                                break;
                            case ("email"):
                                $element->value = $value;
                                break;
                            case("password"):

                                $element->value = "";
                                break;
                            default:
                                //
                        }
                        break;
                    default:
                        // nothing
                }
            }

            // now do selects
            $elements = $dom->find('select[name=' . $name . ']');
            foreach ($elements as $element) {
                $options = $element->find('option');
                foreach ($options as $element1) {
                    if ($element1->value == $value)
                        $element1->selected = true;
                    else {
                        $element1->selected = null;
                    }

                }
            }

            // now do textareas
            $elements = $dom->find('textarea[name=' . $name . ']');
            foreach ($elements as $element) {
                $element->innertext = $value;
            }
        }

        $error_message = "<ul>";
        foreach ($errors as $error) {
            $error_message .= '<li>' . $error . '</li>';
        }
        $error_message .= "</ul>";

        //$error_div = $dom->find('#' . $div)->innertext;
        $error_div = $dom->find('#' . $div, 0);
        $error_div->innertext = $error_message;
        $error_div->class = $css;
        $new_form = $dom->save();

        return $new_form;
    }

}
