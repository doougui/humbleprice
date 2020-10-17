<?php

namespace App\Core;

use App\Models\User;

class Authorization extends DefaultData
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function redirect(string $to): void
    {
        header("Location: {$to}");
        exit;
    }

    protected function authenticated(): object
    {
        if (! isset($_SESSION["user"])) {
            $this->redirect(DIRPAGE);
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
            $this->redirect(DIRPAGE);
        }

        return $this;
    }
}