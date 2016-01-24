<?php
namespace App\Renderers;

use duncan3dc\Laravel\BladeInstance;

/**
 * Class BladeRenderer
 * @package App\Renderers
 */
class BladeRenderer extends BladeInstance implements Renderer
{

    protected $data = [];
    protected $template;

    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view = "", array $params = [])
    {
        if (strlen($view) == 0) {
            $view = $this->template;
        }
        if (sizeof($params) == 0)
            return parent::render($view, $this->data);
        else
            return parent::render($view, $params);

    }


    /**
     * @param $payload
     * @param string $value
     * @return $this
     */
    public function with($payload, $value = "")
    {
        if (is_array($payload)) {
            foreach ($payload as $name => $value) {
                $this->data[$name] = $value;
            }
        } else {
            $this->data[$payload] = $value;
        }

        return $this;
    }


    /**
     * @param $template
     * @return $this
     */
    public function withTemplate($template)
    {
        $this->template = $template;

        return $this;
    }
}
