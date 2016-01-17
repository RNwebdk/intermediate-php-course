<?php

namespace App\Controllers;

use App\Logging\Log;
use App\Session\Session;
use Http\Request;
use Http\Response;
use App\Renderers\BladeRenderer;

/**
 * Class BaseController
 * @package App\Controllers
 */
class BaseController
{

    protected $request;
    protected $response;
    protected $session;
    protected $blade;
    protected $logger;

    /**
     * BaseController constructor.
     * @param Request $request
     * @param Response $response
     * @param Session $session
     * @param BladeRenderer $blade
     * @param Log $logger
     */
    public function __construct(Request $request, Response $response,
                                Session $session, BladeRenderer $blade,
                                Log $logger)
    {
        $this->response = $response;
        $this->request = $request;
        $this->session = $session;
        $this->blade = $blade;
        $this->logger = $logger;
    }


    /**
     * @param $entry
     */
    public function logInfo($entry)
    {
        $this->logger->logInfo($entry);
    }


    /**
     * @param $entry
     */
    public function logWarning($entry)
    {
        $this->logger->logWarning($entry);
    }


    /**
     * @param $entry
     */
    public function logError($entry)
    {
        $this->logger->logError($entry);
    }


    /**
     * @param array $rules
     * @return array
     */
    protected function validate(Array $rules)
    {
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
                        break;
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
                        if (!filter_var($value, FILTER_VALIDATE_FLOAT))
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

        return $errors;
    }


    /**
     * @param $field
     * @return string
     */
    protected function prettify($field)
    {
        return ucwords(str_replace("_", " ", $field));
    }

}
