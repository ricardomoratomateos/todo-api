<?php
namespace TodoAPI\Infrastructure\Controllers;

use Psr\Container\ContainerInterface;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

abstract class AbstractController
{
    const HANDLER = '';

    /** @var $handler */
    protected $handler;

    public function __construct(ContainerInterface $container)
    {
        /** @var HandlerFactory $factory */
        $factory = $container->get('handler-factory');
        $this->handler = $factory->make($this::HANDLER);
    }
}
