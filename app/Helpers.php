<?php

use App\Core\Table;
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
            ["id", "name", "email", "password", "id_role"]
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

function paginate(
    Table $table,
    int $perPage,
    array $where = ["1" => "1"]
): array {
    $count = $table->count($where);

    $currentPage = 1;

    if (isset($_GET["page"])) {
        if (
            strlen(filter_input(
                INPUT_GET,
                "page",
                FILTER_SANITIZE_NUMBER_INT
            )) !== 0) {
            $currentPage = filter_input(
                INPUT_GET,
                "page",
                FILTER_SANITIZE_NUMBER_INT
            );
        }
    }

    $totalPages = ceil($count / $perPage);
    $offset = ($currentPage - 1) * $perPage;

    return [
        "currentPage" => $currentPage,
        "totalPages" => $totalPages,
        "offset" => $offset
    ];
}