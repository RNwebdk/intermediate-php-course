<?php

return [
    ['GET', '/', ['App\Controllers\HomeController', 'show']],
    ['GET', '/test', ['App\Controllers\HomeController', 'test']]
];
