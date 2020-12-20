<?php

namespace TodoAPI\Infrastructure\Middlewares\Exceptions;

use InvalidArgumentException as GlobalInvalidArgumentException;
use JsonSerializable;

class InvalidArgumentException extends GlobalInvalidArgumentException implements JsonSerializable
{
    const CODE = 0;
    const MESSAGE = '';

    public function jsonSerialize()
    {
        return [
            'code' => $this::CODE,
            'message' => $this::MESSAGE,
        ];
    }
}
