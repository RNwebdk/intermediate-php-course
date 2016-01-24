<?php

// these routes are only available to logged in users

return [
    ['GET', '/admin/dashboard', ['App\Controllers\AdminController', 'showDashboard']],
];
