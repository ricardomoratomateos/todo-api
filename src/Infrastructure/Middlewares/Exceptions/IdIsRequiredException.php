<?php

namespace TodoAPI\Infrastructure\Middlewares\Exceptions;

class IdIsRequiredException extends InvalidArgumentException
{
    const CODE = 20001;
    const MESSAGE = "'id' param is required.";
}
