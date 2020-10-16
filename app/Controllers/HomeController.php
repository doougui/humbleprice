<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Offer;

class HomeController extends Controller
{
    public function index(): void
    {
        $offer = new Offer();

        $this->setDir("Home");
        $this->setTitle("Encontre os melhores preços | Humbleprice");
        $this->setDescription("Aqui você encontra os produtos que você deseja com os melhores preços possíveis.");
        $this->setKeywords("ofertas, produtos, preço");

        $this->setData("offers", $offer->getLastOffers());

        $this->renderLayout($this->getData());
    }
}