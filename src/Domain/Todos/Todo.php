<?php

namespace TodoAPI\Domain\Todos;

use JsonSerializable;

class Todo implements JsonSerializable
{
    /** @var int $id */
    private $id;

    /** @var string $name */
    private $name;

    public function __construct(
        ?int $id = null,
        ?string $name = null
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
