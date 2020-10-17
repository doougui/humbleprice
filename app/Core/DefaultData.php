<?php

namespace App\Core;

use App\Models\Category;
use App\Models\User;

class DefaultData extends Controller
{
    public function __construct()
    {
        $this->setCategories();

        if (isset($_SESSION["user"])) {
            $this->setUser();
        }
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