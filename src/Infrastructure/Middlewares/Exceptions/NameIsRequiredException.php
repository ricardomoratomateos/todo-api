<?php

namespace TodoAPI\Infrastructure\Middlewares\Exceptions;

class NameIsRequiredException extends InvalidArgumentException
{
    const CODE = 20003;
    const MESSAGE = "'name' param is required.";
}
