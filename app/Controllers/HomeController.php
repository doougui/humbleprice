<?php

namespace App\Controllers;

use App\Controllers\Render;
use App\Models\Offer;
use App\Models\Forum;
use App\Models\Topic;

class HomeController extends Controller
{
    public function index(): void
    {
        $offer = new Offer();

        $this->setDir("Home");
        $this->setTitle("Encontre os melhores preços | Humbleprice");
        $this->setDescription("Aqui você encontra os produtos que você deseja com os melhores preços possíveis.");
        $this->setKeywords("ofertas, produtos, preço");

        $filter = "";

        if (isset($_GET["filter"])) {
            $filter = filter_input(
                INPUT_GET,
                'filter',
                FILTER_SANITIZE_SPECIAL_CHARS
            );
        }

        $this->setData("offers", $offer->getLastOffers($filter));

        $this->renderLayout($this->getData());
    }
}