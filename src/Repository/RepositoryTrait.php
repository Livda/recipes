<?php

namespace App\Repository;

trait RepositoryTrait
{
    public function genericSave(object $object, bool $flush = true): object
    {
        if (!method_exists($object, 'getId') || null === $object->getId()) {
            $this->getEntityManager()->persist($object);
        }

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $object;
    }

    public function genericDelete(object $object): void
    {
        $this->getEntityManager()->remove($object);
        $this->getEntityManager()->flush();
    }
}
