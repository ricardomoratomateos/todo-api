<?php

namespace TodoAPI\Domain\Todos\Validations\Exceptions;

use TodoAPI\Domain\LogicException;

class TodoDoesNotExistException extends LogicException
{
    const CODE = 10002;
    const MESSAGE = 'TODO does not exist.';
}
