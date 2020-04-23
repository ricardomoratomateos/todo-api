<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Infrastructure\Controllers;

$app->get('/health', Controllers\HealthController::class);

// $app->group('/todos');
$app->get('/todos', Controllers\Todos\ReadTodosController::class);
$app->post('/todos', Controllers\Todos\CreateTodosController::class);
$app->put('/todos/{id}', Controllers\Todos\UpdateTodosController::class);
$app->delete('/todos/{id}', Controllers\Todos\DeleteTodosController::class);

// Enable CORS for development purposes
$app->options('/{routes:.+}', function (Request $request, Response $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});