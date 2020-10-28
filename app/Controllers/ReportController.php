<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Core\Table;
use App\Models\Offer;
use App\Models\Reason;
use App\Models\Report;

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
}