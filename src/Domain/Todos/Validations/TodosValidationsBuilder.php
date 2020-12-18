<?php
namespace TodoAPI\Domain\Todos\Validations;

class TodosValidationsBuilder
{
    protected $repository; 

    public function __construct(
        TodosValidatorRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function build(string $class): ValidationInterface
    {
        return new $class($this->repository);
    }
}
