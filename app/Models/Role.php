<?php

namespace App\Models;

class Role extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "role";
    }
}