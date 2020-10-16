<?php

namespace App\Models;

use App\Core\Table;

class Ability extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "ability";
    }
}