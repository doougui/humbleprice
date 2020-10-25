<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Subcategory;
use Cocur\Slugify\Slugify;

class OfferController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated();
    }

    public function index(): void
    {
        $this->redirect(DIRPAGE);
    }

    public function suggest(): void
    {
        $this->setDir("Suggest");
        $this->setTitle("Sugira uma promoção | Humbleprice");
        $this->setDescription("Sugira uma oferta/promoção instingante de algum estabelecimento de nossa confiança.");
        $this->setKeywords("offer, suggest, low-price, price, discount");

        $this->renderLayout($this->getData());
    }

    public function publish(): ?bool
    {
        $offer = new Offer();
        $category = new Category();
        $subcategory = new Subcategory();
        $slugify = new Slugify();

        if (
            isset($_POST["link"]) && isset($_POST["name"])
            && isset($_POST["old-price"]) && isset($_POST["new-price"])
            && isset($_POST["category"]) && isset($_POST["subcategory"])
            && isset($_FILES["picture"])
        ) {
            $link = filter_input(
                INPUT_POST,
                "link",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $name = filter_input(
                INPUT_POST,
                "name",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $slug = $slugify->Slugify($name);
            $oldPrice = filter_input(
                INPUT_POST,
                "old-price",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $newPrice = filter_input(
                INPUT_POST,
                "new-price",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $categorySlug = filter_input(
                INPUT_POST,
                "category",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $subcategorySlug = filter_input(
                INPUT_POST,
                "subcategory",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $picture = $_FILES["picture"];

            if (
                isset($_POST["end-offer"])
                && ! isset($_POST["offer-end-date-not-specified"])
            ) {
                $endOffer = filter_input(
                    INPUT_POST,
                    "end-offer",
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }

            if (
                strlen($link) !== 0 && strlen($name) !== 0
                && strlen($oldPrice) !== 0 && strlen($newPrice) !== 0
                && strlen($categorySlug) !== 0 && strlen($subcategorySlug) !== 0
                && ! empty($_FILES["picture"])
            ) {
                $oldPrice = floatval(str_replace(",",".", $oldPrice));
                $newPrice = floatval(str_replace(",",".", $newPrice));

                $endOffer = (isset($endOffer) && strlen($endOffer) !== 0)
                        ? $endOffer
                        : null;

                $categoryId = $category->getId("slug", $categorySlug);

                if (! $categoryId) {
                    die("Uma categoria inválida foi irformada. Por favor, selecione outra.");
                }

                $subcategoryId = $subcategory->getId("slug", $subcategorySlug);

                if (! $subcategoryId) {
                    die("Uma subcategoria inválida foi irformada. Por favor, selecione outra.");
                }

                if (! $subcategory->isChildOf(
                    $subcategoryId,
                    $categoryId,
                    "category")
                ) {
                    die("Esta subcategoria não pertence a respectiva categoria.");
                }

                $type = $picture["type"];

                if (in_array($type, ["image/jpeg", "image/png"])) {
                    $imageName = md5(time().rand(0, 99999)).".jpg";
                    move_uploaded_file(
                        $picture["tmp_name"],
                        DIRREQ."public/img/products/{$imageName}"
                    );

                    list(
                        $originalWidth,
                        $originalHeight
                    ) = getimagesize(
                        DIRREQ."public/img/products/{$imageName}"
                    );

                    $ratio = $originalWidth / $originalHeight;

                    $width = 500;
                    $height = 500;

                    if ($width / $height > $ratio) {
                        $width = $height * $ratio;
                    } else {
                        $height = $width / $ratio;
                    }

                    $img = imagecreatetruecolor($width, $height);

                    if ($type == "image/jpeg") {
                        $original = imagecreatefromjpeg(
                            DIRREQ."public/img/products/{$imageName}"
                        );
                    } elseif ($type == "image/png") {
                        $original = imagecreatefrompng(
                            DIRREQ . "public/img/products/{$imageName}"
                        );
                    } else {
                        die("A imagem deve ser do tipo JPEG, JPG ou PNG");
                    }

                    imagecopyresampled(
                        $img,
                        $original,
                        0,
                        0,
                        0,
                        0,
                        $width,
                        $height,
                        $originalWidth,
                        $originalHeight
                    );

                    imagejpeg(
                        $img,
                        DIRREQ."public/img/products/{$imageName}",
                        80
                    );

                    $info = [
                        "slug" => $slug,
                        "link" => $link,
                        "name" => $name,
                        "oldPrice" => $oldPrice,
                        "newPrice" => $newPrice,
                        "categoryId" => $categoryId,
                        "subcategoryId" => $subcategoryId,
                        "picture" => $imageName,
                        "endOffer" => $endOffer
                    ];

                    if ($offer->register($info)) {
                        return true;
                    }

                    die("Algo de errado ocorreu. Tente novamente mais tarde!");
                }

                die("A imagem deve ser do tipo JPEG, JPG ou PNG");
            }
        }

        die("Preencha todos os campos para continuar");
    }

    public function subcategory(string $slug = null): void
    {
        $this->authenticated()->withPermission("MANAGE_OFFERS");

        $offer = new Offer();
        $subcategory = new Subcategory();

        if (empty($slug)) {
            die();
        }

        $offerId = $offer->getId("slug", $slug);

        if (! $offerId) {
            die();
        }

        $subcategoryId = $offer->getInfo(
            "id",
            $offerId,
            ["id_subcategory"]
        )["id_subcategory"];

        die($subcategory->getInfo("id", $subcategoryId, ["slug"])["slug"]);
    }

    public function edit(string $slug = null): void
    {
        $this->authenticated()->withPermission("MANAGE_OFFERS");

        $offer = new Offer();
        $category = new Category();
        $subcategory = new Subcategory();

        if (empty($slug)) {
            $this->redirect(DIRPAGE);
        }

        $offerId = $offer->getId("slug", $slug);

        if (! $offerId) {
            $this->redirect(DIRPAGE);
        }

        $this->setDir("Edit");
        $this->setTitle("Encontre os melhores preços | Humbleprice");
        $this->setDescription("Aqui você encontra os produtos que você deseja com os melhores preços possíveis.");
        $this->setKeywords("ofertas, produtos, preço");

        $offerData = $offer->getInfo("id", $offerId,
            [
                "id_category",
                "id_subcategory",
                "slug",
                "link",
                "name",
                "old_price",
                "new_price",
                "image",
                "end_offer"
            ]
        );

        $categoryData = $category->getInfo(
            "id",
            $offerData["id_category"],
            ["name", "slug"]
        );

        $subcategoryData = $subcategory->getInfo(
            "id",
            $offerData["id_subcategory"],
            ["name", "slug"]
        );

        $this->setData("offer", $offerData);
        $this->setData("currentCategory", $categoryData);
        $this->setData("currentSubcategory", $subcategoryData);

        $this->renderLayout($this->getData());
    }

    public function delete(string $slug = null): ?bool
    {
        $this->authenticated()->withPermission("MANAGE_OFFERS");

        $offer = new Offer();

        if (empty($slug)) {
            die("Esta oferta é inválida.");
        }

        $offerId = $offer->getId("slug", $slug);

        if (! $offerId) {
            die("Esta oferta é inválida.");
        }

        if ($offer->delete($offerId)) {
            return true;
        }

        die("Não foi possível deletar esta oferta.");
    }
}