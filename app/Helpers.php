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
            "id",
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

    if (! empty(user()["id_role"])) {
        return $user->hasPermission(user()["id_role"], $permission);
    }

    return false;
}

function startsWith(string $startString, string $string): bool
{
    $length = strlen($startString);

    return substr($string, 0, $length) === $startString;
}

function endsWith(string $endString, string $string): bool
{
    $length = strlen($endString);

    if ($length == 0) {
        return true;
    }

    return substr($string, -$length) === $endString;
}