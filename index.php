<?php

use TodoAPI\Domain\EventHandler;
use TodoAPI\Infrastructure\Logger\InMemoryLogger;

require __DIR__ . '/vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$eventHandler = EventHandler::setLogger(new InMemoryLogger());
$app = new \Slim\App($configuration);

require __DIR__ . '/src/Infrastructure/constants.php';
require __DIR__ . '/src/Infrastructure/container.php';
require __DIR__ . '/src/Infrastructure/routes.php';

$app->run();
