<?php

namespace App\Http;

use Stevebauman\EloquentTable\TableTrait;
use Illuminate\Database\Eloquent\Collection;

class RestCollection extends Collection
{
    use TableTrait;

    public function __construct($items = [])
    {
        $objectItens = [];

        foreach ($items as $item) {
            $objectItens[] = (object)$item;
        }

        parent::__construct($objectItens);
    }
}