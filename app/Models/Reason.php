<?php

namespace App\Models;

use App\Core\Table;

class Reason extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "reasons";
    }
}