<?php

namespace App\Controllers;

use App\Core\Controller;
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

        $categoryId = $category->getId("slug", $slug);
        $categoryInfo = $category->getInfo($categoryId,
            ['id', 'name', 'slug']
        );

        $this->setDir("Category");
        $this->setTitle("Ofertas de {$categoryInfo['name']} | Humbleprice");
        $this->setDescription("Aqui você encontra as melhores ofertas de {$categoryInfo['name']}");
        $this->setKeywords("ofertas, produtos, preço, {$categoryInfo['name']}");

        if (empty($slug)) {
            header("Location: ".DIRPAGE);
            exit;
        }

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

        $this->setData("subcategories", $category->subcategories($categoryId));
        $this->setData("offers", $offer->getLastOffers(
            $categoryId,
            $subcategoryId
        ));
        $this->setData("category", $categoryInfo);

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