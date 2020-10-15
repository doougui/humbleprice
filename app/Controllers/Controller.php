<?php

namespace App\Controllers;

use App\Models\Category;

class Controller extends Render
{
    private array $data;

    public function __construct()
    {
        $this->getCategories();
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    private function getCategories(): void
    {
        $category = new Category();

        $this->setData(
            "categories",
            $category->getAll(["id", "slug", "name"])
        );
    }
}