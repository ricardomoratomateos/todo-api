<?php

use TodoAPI\Infrastructure\Handlers\HandlerFactory;
use TodoAPI\Infrastructure\Repositories\RepositoryFactory;
use TodoAPI\Infrastructure\Storages\StorageFactory;

$container = $app->getContainer();

$container['conf'] = function() {
    $config = parse_ini_file(CONF_DIR . '/database.ini', true);

    return $config;
};

$container['connection'] = function() use ($container) {
    $params = $container->get('conf')['database-config'];
    $config = new \Doctrine\DBAL\Configuration();

    return \Doctrine\DBAL\DriverManager::getConnection($params, $config);
};

$container['repository-factory'] = function() use ($container) {
    return new RepositoryFactory($container->get('connection'));
};

$container['storage-factory'] = function() use ($container) {
    return new StorageFactory($container->get('connection'));
};

$container['handler-factory'] = function() use ($container) {
    return new HandlerFactory(
        $container->get('repository-factory'),
        $container->get('storage-factory')
    );
};

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        if (get_class($exception) === InvalidArgumentException::class) {
            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'text/html')
                ->withJson(['error' => $exception->getMessage()]);
        }

        return $response
            ->withStatus(500)
            ->withHeader('Content-Type', 'text/html');
    };
};
