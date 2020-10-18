<?php

namespace App\Core;

use App\Models\User;

class Authorization extends DefaultData
{
    public function __construct()
    {
        parent::__construct();

        if (isset($_SESSION["user"])) {
            $this->isSuspended();
        }
    }

    public function logout(): void
    {
        unset($_SESSION["user"]);

        if ($this->getData()["currentUrl"] != DIRPAGE."login") {
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
            $this->getData()["user"]["id_role"],
            $permission
        )) {
            $this->redirect(DIRPAGE);
        }

        return $this;
    }

    private function isSuspended(): void
    {
        $user = new User();
        $email = $this->getData()["user"]["email"];

        $currentUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        $allowedRoutesForSuspendedUsers = [
            DIRPAGE."user/suspended/{$email}",
            DIRPAGE."login",
            DIRPAGE."register",
            DIRPAGE."login/logout",
        ];

        if (! in_array($currentUrl, $allowedRoutesForSuspendedUsers)) {
            if ($user->isSuspended($email)) {
                $this->redirect($allowedRoutesForSuspendedUsers[0]);
            }
        } else if (
            $currentUrl === $allowedRoutesForSuspendedUsers[0]
            && ! $user->isSuspended($email)
        ) {
            $this->redirect(DIRPAGE);
        }
    }
}