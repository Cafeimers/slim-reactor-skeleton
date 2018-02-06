#!/usr/bin/env php
<?php

use CrazyGoat\SlimReactor\{SlimReactor, SlimReactorApp};

if (PHP_SAPI != 'cli') {
    throw new RuntimeException('Can only run in cli');
}

require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new SlimReactorApp($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

$slimReactor  = new SlimReactor(
    $app,
    [
        'socket' => isset($argv[1]) ? $argv[1] : '0.0.0.0:0'
    ]
);
$slimReactor->run();
