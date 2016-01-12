<?php

return [
    ['GET', '/', ['App\Controllers\HomeController', 'show']],
    ['GET', '/test', ['App\Controllers\HomeController', 'test']],
    ['GET', '/test-page', ['App\Controllers\HomeController', 'testPage']],
    ['GET', '/test-page-and-log', ['App\Controllers\HomeController', 'testPageAndLog']]
];
