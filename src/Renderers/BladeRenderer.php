<?php
namespace App\Renderers;

use duncan3dc\Laravel\BladeInstance;

class BladeRenderer extends BladeInstance implements Renderer
{

    protected $data = [];

    public function render($view, array $params = [])
    {
        if (sizeof($params) == 0)
            return parent::render($view, $this->data);
        else
            return parent::render($view, $params);
    }

    public function with($array)
    {
        foreach ($array as $name => $value) {
            $this->data[$name] = $value;
        }

    }
}
