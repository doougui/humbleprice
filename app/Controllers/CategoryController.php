<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Subcategory;

class CategoryController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->redirect(DIRPAGE);
    }

    public function offers(string $slug = null): void
    {
        $category = new Category();
        $subcategory = new Subcategory();
        $offer = new Offer();

        if (
            empty($slug)
            || ! $categoryId = $category->getId("slug", $slug)
        ) {
            $this->redirect(DIRPAGE);
        }

        $categoryInfo = $category->getInfo(
            "id",
            $categoryId,
            ['id', 'name', 'slug']
        );

        $this->setDir("Category");
        $this->setTitle("Ofertas de {$categoryInfo['name']} | Humbleprice");
        $this->setDescription("Aqui você encontra as melhores ofertas de {$categoryInfo['name']}");
        $this->setKeywords("ofertas, produtos, preço, {$categoryInfo['name']}");

        $subcategoryId = null;

        if (isset($_GET["subcategory"])) {
            $subcategoryFilter = filter_input(
                INPUT_GET,
                "subcategory",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            $subcategoryId = $subcategory->getId("slug", $subcategoryFilter);

            if (! $subcategoryId ||
                ! $subcategory->isChildOf(
                $subcategoryId,
                $categoryId,
                "category"
            )) {
                $this->redirect(DIRPAGE."category/offers/{$slug}");
            }
        }

        $this->setData("subcategories", $category->subcategories($categoryId));
        $this->setData("offers", $offer->getLastOffers(
            $categoryId,
            $subcategoryId
        ));
        $this->setData("category", $categoryInfo);

        $this->renderLayout($this->getData());
    }

    public function subcategories(string $slug = null): void
    {
        $subcategory = new Subcategory();
        $category = new Category();

        if (! $this->isAjax()) {
            $this->redirect(DIRPAGE);
        }

        if (
            empty($slug)
            || ! $categoryId = $category->getId("slug", $slug)
        ) {
            die(json_encode([]));
        }

        die(json_encode(
            $subcategory->getFromCategory($categoryId)
        ));
    }
}