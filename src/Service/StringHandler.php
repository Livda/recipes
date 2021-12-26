<?php

namespace App\Service;

trait StringHandler
{
    public function nullable(?string $data): ?string
    {
        if (null === $data) {
            return null;
        }

        $trimmed = trim($data);
        if ('' === $trimmed) {
            return null;
        }

        return $trimmed;
    }
}
