<?php

namespace App\Core;

use App\Models\Category;
use App\Models\User;

class Controller extends Render
{
    private array $data;

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }
}