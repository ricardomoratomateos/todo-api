<?php

namespace TodoAPI\Domain\Todos\Validations;

interface TodosValidatorRepositoryInterface
{
    /**
     * @param int[] $ids
     * @return array
     */
    public function getByIDs(array $ids): array;

    /**
     * @param string[] $names
     * @return array
     */
    public function getByNames(array $names): array;
}
