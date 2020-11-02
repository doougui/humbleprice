<?php

namespace App\Core;

use App\Models\Category;
use App\Models\User;

class Controller extends Render
{
    private array $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function isAjax(): bool
    {
        return
            isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}