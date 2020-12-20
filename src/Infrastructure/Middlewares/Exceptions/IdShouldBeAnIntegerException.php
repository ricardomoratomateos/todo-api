<?php

namespace TodoAPI\Infrastructure\Middlewares\Exceptions;

class IdShouldBeAnIntegerException extends InvalidArgumentException
{
    const CODE = 20002;
    const MESSAGE = "'id' param should be an integer.";
}
