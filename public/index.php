<?php
require __DIR__ . '/../bootstrap/start.php';
$world = getenv('TEST_VAR');
echo "Hello, " . $world;

