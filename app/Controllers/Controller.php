<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\User;

class Controller extends Render
{
    private array $data;

    public function __construct()
    {
        $this->setCategories();

        if (isset($_SESSION["user"])) {
            $this->setUser();
        }
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    private function setCategories(): void
    {
        $category = new Category();

        $this->setData(
            "categories",
            $category->getAll(["id", "slug", "name"])
        );
    }

    private function setUser(): void
    {
        $user = new User();

        $this->setData("user", $user->getInfo(
            $_SESSION["user"],
            ['name', 'email', 'password', 'id_role']
        ));
    }
}