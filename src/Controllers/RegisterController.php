<?php
namespace App\Controllers;

class RegisterController extends BaseController {

    public function showRegister()
    {
        return $this->response->setContent($this->blade->render("register"));
    }


    public function handleRegister()
    {
        $rules = [
            'first_name'    => 'required|ip',
            'last_name'     => 'required|min:3',
            'email'         => 'required|email',
            'confirm-email' => 'required|email|equalTo:email',
            'agree'         => 'required',
        ];

        $errors = [];

        foreach ($rules as $field => $allrules) {
            $value = $this->request->getParameter($field);
            $exploded = explode("|", $allrules);

            foreach ($exploded as $rule) {
                $this_rule = explode(":", $rule);
                $rule_to_check = $this_rule[0];

                switch ($rule_to_check) {
                    case "required":
                        if ($value == "")
                            $errors[] = $this->prettify($field) . " is required!";
                        break;
                    case "min":
                        $length = $this_rule[1];
                        if (strlen($value) < $length)
                            $errors[] = $this->prettify($field) . " must be at least " . $length . " characters!";
                        break;
                    case "max":
                        $length = $this_rule[1];
                        if (strlen($value) > $length)
                            $errors[] = $this->prettify($field) . " must be no more than " . $length . " characters!";
                        break;
                    case "email":
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                            $errors[] = $this->prettify($field) . " must be a valid email address!";
                        break;
                    case "equalTo":
                        $matching_field = $this->request->getParameter($this_rule[1]);
                        if ($matching_field !== $value)
                            $errors[] = $this->prettify($field) . " must be equal to " . $this->prettify($this_rule[1]);
                    case "greaterThan":
                        $testValue = $this_rule[1];
                        if ($value < $testValue)
                            $errors[] = $this->prettify($field) . " must be greater than " . $testValue;
                        break;
                    case "lessThan":
                        $testValue = $this_rule[1];
                        if ($value > $testValue)
                            $errors[] = $this->prettify($field) . " must be less than " . $testValue;
                        break;
                    case "digits":
                        if (!filter_var($value, FILTER_VALIDATE_INT))
                            $errors[] = $this->prettify($field) . " must contain only digits!";
                        break;
                    case "float":
                        if (!filter_var($value, FILTER_VALIDATE_INT))
                            $errors[] = $this->prettify($field) . " must be a decimal number!";
                        break;
                    case "url":
                        if (!filter_var($value, FILTER_VALIDATE_URL))
                            $errors[] = $this->prettify($field) . " must be a valid URL!";
                        break;
                    case "ip":
                        if (!filter_var($value, FILTER_VALIDATE_IP))
                            $errors[] = $this->prettify($field) . " must be a valid IP address!";
                        break;

                    default:
                        //
                }
            }
        }
        dd($errors);
    }


    protected function prettify($field)
    {
        return ucwords(str_replace("_", " ", $field));
    }
}
