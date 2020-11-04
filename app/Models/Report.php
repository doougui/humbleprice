<?php

namespace App\Models;

use App\Core\Table;

class Report extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "reports";
    }
}