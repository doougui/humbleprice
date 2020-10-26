<?php

namespace App\Core;

use App\Models\User;

class Authorization extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION["user"])) {
            $this->isSuspended();
        }
    }

    public function logout(bool $redirect = true): void
    {
        unset($_SESSION["user"]);

        if (currentUrl() !== DIRPAGE."login" && $redirect) {
            $this->redirect(DIRPAGE."login");
        }
    }

    protected function redirect(string $to): void
    {
        header("Location: {$to}");
        exit;
    }

    protected function authenticated(): bool
    {
        if (! isset($_SESSION["user"])) {
            return false;
        }

        return true;
    }

    protected function authRequired(): Authorization
    {
        if (! $this->authenticated()) {
            $this->redirect(DIRPAGE);
        }

        return $this;
    }

    protected function hasPermission(string $permission): bool
    {
        $user = new User();

        if (! user()) {
            return false;
        }

        if (! $user->hasPermission(
            user()["id_role"],
            $permission
        )) {
            return false;
        }

        return true;
    }

    protected function withPermission(string $permission): Authorization
    {
        if (! $this->hasPermission($permission)) {
            $this->redirect(DIRPAGE);
        }

        return $this;
    }

    private function isSuspended(): void
    {
        $user = new User();
        $email = user()["email"];

        $allowedRoutesForSuspendedUsers = [
            DIRPAGE."user/suspended/{$email}",
            DIRPAGE."login",
            DIRPAGE."register",
            DIRPAGE."login/logout",
        ];

        if (! in_array(currentUrl(), $allowedRoutesForSuspendedUsers)) {
            if ($user->isSuspended($email)) {
                $this->redirect($allowedRoutesForSuspendedUsers[0]);
            }
        } elseif (
            currentUrl() === $allowedRoutesForSuspendedUsers[0]
            && ! $user->isSuspended($email)
        ) {
            $this->redirect(DIRPAGE);
        }
    }
}