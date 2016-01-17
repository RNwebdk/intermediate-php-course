<?php
namespace App\Renderers;

/**
 * Interface Renderer
 * @package App\Renderers
 */
interface Renderer
{

    /**
     * @param $template
     * @return mixed
     */
    public function render($template);


    /**
     * @param $payload
     * @param $value
     * @return mixed
     */
    public function with($payload, $value);


    /**
     * @param $template
     * @return mixed
     */
    public function withTemplate($template);

}
