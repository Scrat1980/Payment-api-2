<?php

namespace App;

use App\Entity\PriceRequest;

class Populator
{
    public function populate($dto, $object)
    {
        foreach ($object as $property => $value) {
            if (property_exists($dto, $property)) {
                $object->{$property} = $dto->{$property};
            }
        }

        return $object;
    }
}