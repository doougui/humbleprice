<?php

namespace App\Controllers;

use App\Core\Authorization;

class ReportController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authRequired()->withPermission("MANAGE_OFFERS");
    }

    public function index(): void
    {
        
    }

    public function unavailable(string $slug = null): ?bool
    {
        return true;
    }
}