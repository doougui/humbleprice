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

    public function logout(): void
    {
        unset($_SESSION["user"]);

        if (currentUrl() !== DIRPAGE."login") {
            $this->redirect(DIRPAGE."login");
        }
    }

    protected function redirect(string $to): void
    {
        header("Location: {$to}");
        exit;
    }

    protected function authenticated(): Authorization
    {
        if (! isset($_SESSION["user"])) {
            $this->redirect(DIRPAGE);
        }

        return $this;
    }

    protected function withPermission(string $permission): Authorization
    {
        $user = new User();

        if (! $user->hasPermission(
            user()["id_role"],
            $permission
        )) {
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
        } else if (
            currentUrl() === $allowedRoutesForSuspendedUsers[0]
            && ! $user->isSuspended($email)
        ) {
            $this->redirect(DIRPAGE);
        }
    }
}