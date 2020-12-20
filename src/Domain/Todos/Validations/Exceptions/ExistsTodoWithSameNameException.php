<?php

namespace TodoAPI\Domain\Todos\Validations\Exceptions;

use TodoAPI\Domain\LogicException;

class ExistsTodoWithSameNameException extends LogicException
{
    const CODE = 1;
}
