<?php

return [
    ['GET', '/', ['App\Controllers\PageController', 'showHome']],
    ['GET', '/register', ['App\Controllers\RegisterController', 'showRegister']],
    ['POST', '/register', ['App\Controllers\RegisterController', 'handleRegister']],
    ['GET', '/{slug}', ['App\Controllers\PageController', 'showPage']],
];
