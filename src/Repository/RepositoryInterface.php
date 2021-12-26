<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function genericSave(object $object, bool $flush = true): object;

    public function genericDelete(object $object): void;
}
