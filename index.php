<?php
require __DIR__ . '/vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($configuration);

require __DIR__ . '/src/Infrastructure/constants.php';
require __DIR__ . '/src/Infrastructure/container.php';
require __DIR__ . '/src/Infrastructure/routes.php';

$app->run();
