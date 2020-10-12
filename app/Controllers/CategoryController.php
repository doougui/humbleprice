<?php

namespace App\Controllers;

use App\Models\Subcategory;

class CategoryController extends Render
{
    public function subcategories(string $category = ""): void
    {
        $data = [];

        $subcategory = new Subcategory();

        if (empty($category)) {
            die(json_encode([]));
        }

        die(json_encode(
            $subcategory->getFromCategory($category)
        ));
    }
}