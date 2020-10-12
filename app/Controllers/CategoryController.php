<?php

namespace App\Controllers;

use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index()
    {

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