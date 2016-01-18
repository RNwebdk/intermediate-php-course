<?php

return [
    ['GET', '/', ['App\Controllers\PageController', 'showHome']],
    ['GET', '/register', ['App\Controllers\RegisterController', 'showRegister']],
    ['POST', '/register', ['App\Controllers\RegisterController', 'handleRegister']],
    ['GET', '/login', ['App\Controllers\AuthenticationController', 'showLogin']],
    ['POST', '/login', ['App\Controllers\AuthenticationController', 'handleLogin']],
    ['GET', '/{slug}', ['App\Controllers\PageController', 'showPage']],
];
