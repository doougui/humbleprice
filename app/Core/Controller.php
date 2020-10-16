<?php

namespace App\Core;

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

    protected function authenticated(): object
    {
        if (! isset($_SESSION["user"])) {
            header("Location: ".DIRPAGE);
            exit;
        }

        return $this;
    }

    protected function withPermission(string $permission): object
    {
        $user = new User();

        if (! $user->hasPermission(
            $this->getData()["user"]["id_role"],
            $permission
        )) {
            header("Location: ".DIRPAGE);
            exit;
        }

        return $this;
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