<?php

namespace App\Controllers;

use App\Controllers\Render;

class NotfoundController extends Controller
{
    public function index(): void
    {
        $this->setDir("404");
        $this->setTitle("Página não encontrada | Humbleprice");
        $this->setDescription("Erro 404, Página não encontrada.");
        $this->setKeywords("erro 404, not found, error");

        $this->renderLayout($this->getData());
    }
}