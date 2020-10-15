<?php

namespace App\Models;

class Ability extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "ability";
    }
}