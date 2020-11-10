<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;

class HomeController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $offer = new Offer();

        $this->setDir("Home");
        $this->setTitle("Encontre os melhores preços | Humbleprice");
        $this->setDescription("Aqui você encontra os produtos que você deseja com os melhores preços possíveis.");
        $this->setKeywords("ofertas, produtos, preço");

        $perPage = 30;
        $pagination = paginate($offer, $perPage, ["status" => "approved"]);

        $this->setData("offers", $offer->getLastOffers(
            $pagination["offset"],
            $perPage
        ));

        $this->setData("totalPages", $pagination["totalPages"]);
        $this->setData("currentPage", $pagination["currentPage"]);

        $this->renderLayout($this->getData());
    }
}