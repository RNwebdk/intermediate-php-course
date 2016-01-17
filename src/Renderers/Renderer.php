<?php
namespace App\Renderers;

interface Renderer
{

    public function render($template);

    public function with($payload, $value);
}
