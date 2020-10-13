<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index(): void
    {
        header("Location: ".DIRPAGE);
        exit;
    }

    public function show(string $slug = ""): void
    {
        $category = new Category();
        $subcategory = new Subcategory();
        $offer = new Offer();

        $this->setDir("Home");
        $this->setTitle("Encontre os melhores preços | Humbleprice");
        $this->setDescription("Aqui você encontra os produtos que você deseja com os melhores preços possíveis.");
        $this->setKeywords("ofertas, produtos, preço");

        if (empty($slug)) {
            header("Location: ".DIRPAGE);
            exit;
        }

        $categoryId = $category->getId("slug", $slug);
        $subcategoryId = null;

        if (isset($_GET["subcategory"])) {
            $subcategoryFilter = filter_input(
                INPUT_GET,
                "subcategory",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            $subcategoryId = $subcategory->getId("slug", $subcategoryFilter);

            if (! $subcategory->isChildOf(
                $subcategoryId,
                $categoryId,
                "category")
            ) {
                header("Location: ".DIRPAGE."category/show/{$slug}");
                exit;
            }
        }

        $this->setData("offers", $offer->getLastOffers(
            $categoryId,
            $subcategoryId
        ));

        $this->renderLayout($this->getData());
    }

    public function subcategories(string $category = ""): void
    {
        $subcategory = new Subcategory();

        if (empty($category)) {
            die(json_encode([]));
        }

        die(json_encode(
            $subcategory->getFromCategory($category)
        ));
    }
}