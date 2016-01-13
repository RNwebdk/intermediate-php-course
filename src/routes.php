<?php

return [
    ['GET', '/', ['App\Controllers\PageController', 'showHome']],
    ['GET', '/{slug}', ['App\Controllers\PageController', 'showPage']],
];
