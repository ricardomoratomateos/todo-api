<?php

namespace TodoAPI\Domain\Todos\Validations\Exceptions;

use TodoAPI\Domain\LogicException;

class ExistsTodoWithSameNameException extends LogicException
{
    const CODE = 10001;
    const MESSAGE = 'Exists a TODO with the same name.';
}
