<?php

namespace TodoAPI\Domain;

use JsonSerializable;
use LogicException as GlobalLogicException;

class LogicException extends GlobalLogicException implements JsonSerializable
{
    const CODE = '';

    public function jsonSerialize()
    {
        return [
            'code' => $this::CODE
        ];
    }
}
