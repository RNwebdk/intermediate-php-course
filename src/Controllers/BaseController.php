<?php

namespace App\Controllers;

use App\Logging\Log;
use App\Session\Session;
use Http\Request;
use Http\Response;
use App\Renderers\BladeRenderer;
use Sunra\PhpSimple\HtmlDomParser;

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
                    case "unique":
                        $table = 'App\\Models\\' . $this_rule[1];
                        $column = $this_rule[2];
                        $model = new $table();
                        $results = $model->where($column, '=', $value)->get();
                        if (sizeof($results->toArray()) > 0)
                            $errors[] = $this->prettify($field) . " already exists in this system!";
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


    /**
     * @param $html
     * @param $errors
     * @param $paramters
     * @param string $div
     * @param string $css
     * @return mixed
     */
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

        // generate error message
        $error_message = "<ul>";
        foreach ($errors as $error) {
            $error_message .= '<li>' . $error . '</li>';
        }
        $error_message .= "</ul>";

        // insert error message
        $error_div = $dom->find('#' . $div, 0);
        $error_div->innertext = $error_message;
        $error_div->class = $css;

        return $dom->save();
    }


    /**
     * @param $blade
     * @param $template
     * @return mixed
     */
    public function showTemplatedPage($template)
    {
        return $this->response->setContent($this->blade
            ->with('session', $this->session)
            ->withTemplate($template)->render());
    }


    /**
     * @param $slug
     * @return array|bool
     */
    protected function getPageBySlug($slug)
    {
        $result = $this->page->where('slug', '=', $slug)->first();

        if ($result !== null) {
            return [
                'page_title'    => $result->page_title,
                'page_content'  => $result->page_content,
                'browser_title' => $result->browser_title,
                'session'       => $this->session,
            ];
        } else {
            return false;
        }
    }

}
