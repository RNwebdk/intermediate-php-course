<?php

// these routes are only available to logged in users

return [
    ['GET', '/admin/secret', ['App\Controllers\AdminController', 'showSecret']],
];
