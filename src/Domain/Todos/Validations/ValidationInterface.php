<?php
namespace TodoAPI\Domain\Todos\Validations;

interface ValidationInterface
{
    /**
     * @param Todo[] $todos
     * @return void
     * @throws Exception
     */
    public function __invoke(array $todos): void;
}
