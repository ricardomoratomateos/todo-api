<?php
namespace TodoAPI\Infrastructure\Controllers;

use Psr\Container\ContainerInterface;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

abstract class AbstractController
{
    /** @var ContainerInterface $container */
    protected $container;

    /** @var HandlerFactory $handlerFactory */
    protected $handlerFactory;

    public function __construct(ContainerInterface $container)
    {
        /** @var HandlerFactory $factory */
        $this->container = $container;
        $this->handlerFactory = $container->get('handler-factory');
    }
}
