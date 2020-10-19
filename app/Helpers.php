<?php

use App\Models\Category;
use App\Models\User;

function categories(): array
{
    $category = new Category();

    return $category->getAll(["id", "slug", "name"]);
}

function user(): ?array
{
    $user = new User();

    if (isset($_SESSION["user"])) {
        return $user->getInfo(
            $_SESSION["user"],
            ["name", "email", "password", "id_role"]
        );
    }

    return [];
}

function currentUrl(): string
{
    return "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
}

function authorized(string $permission): bool
{
    $user = new User();

    return $user->hasPermission(user()["id_role"], $permission);
}