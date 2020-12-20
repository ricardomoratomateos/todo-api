<?php

namespace TodoAPI\Domain\Todos\Validations;

abstract class AbstractTodosValidation implements ValidationInterface
{
    protected $repository;

    public function __construct(
        TodosValidatorRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
}
