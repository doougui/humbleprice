<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\User;

class UserController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->redirect(DIRPAGE);
    }

    public function edit(): void
    {
        $this->authRequired();

        $user = new User();

        $this->setDir('EditUser');
        $this->setTitle('Edite seu perfil | Humbleprice');
        $this->setDescription('Aqui você pode editar todas as informações do seu perfil de usuário.');
        $this->setKeywords('offer, profile, editar, perfil');

        $this->setData("user", $user->getInfo("id", user()["id"],
                ["name", "email", "avatar"]
            )
        );

        $this->renderLayout($this->getData());
    }

    public function update(): void
    {
        $this->authRequired();

        if (isset($_POST["name"]) && isset($_POST["email"])) {
            $name = filter_input(
                INPUT_POST,
                "name",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $email = filter_input(
                INPUT_POST,
                "email",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            if (! empty($_FILES["picture"]["size"])) {
                $picture = $_FILES["picture"];
            }

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
            ) {
                $oldPrice = floatval(str_replace(",", ".", $oldPrice));
                $newPrice = floatval(str_replace(",", ".", $newPrice));

                $endOffer = (isset($endOffer) && strlen($endOffer) !== 0)
                    ? $endOffer
                    : null;

                $additionalInfo = (
                    isset($additionalInfo)
                    && strlen($additionalInfo) !== 0
                )
                    ? $additionalInfo
                    : null;

                $categoryId = $category->getId("slug", $categorySlug);

                if (! $categoryId) {
                    die(
                        json_encode(
                            [
                                "error" => "Uma categoria inválida foi 
                                selecionada. Por favor, selecione outra."
                            ]
                        )
                    );
                }

                $subcategoryId = $subcategory->getId("slug", $subcategorySlug);

                if (! $subcategoryId) {
                    die(
                        json_encode(
                            [
                                "error" => "Uma subcategoria inválida foi 
                                    selecionada. Por favor, selecione outra."
                            ]
                        )
                    );
                }

                if (!$subcategory->isChildOf(
                    $subcategoryId,
                    $categoryId,
                    "category")
                ) {
                    die(
                        json_encode(
                            [
                                "error" => "Esta subcategoria não pertence a 
                                    respectiva categoria."
                            ]
                        )
                    );
                }

                if (isset($picture)) {
                    $imageName = $this->treatImage($picture);
                }

                $info = [
                    "offerId" => $offerId,
                    "slug" => $slug,
                    "link" => $link,
                    "name" => $name,
                    "additionalInfo" => $additionalInfo,
                    "oldPrice" => $oldPrice,
                    "newPrice" => $newPrice,
                    "categoryId" => $categoryId,
                    "subcategoryId" => $subcategoryId,
                    "endOffer" => $endOffer
                ];

                if (isset($imageName)) {
                    $info["picture"] = $imageName;
                }

                if ($offer->update($info)) {
                    die(json_encode([]));
                }

                die(
                    json_encode(
                        [
                            "error" => "Algo de errado ocorreu. 
                            Tente novamente mais tarde!"
                        ]
                    )
                );
            }
        }

        die(
            json_encode(
                [
                    "error" => "Preencha todos os campos para continuar"
                ]
            )
        );
    }

    public function delete(): void
    {

    }

    public function suspended(string $email = null): void
    {
        $loggedEmail = user()["email"];

        if ($email !== $loggedEmail) {
            $this->redirect(DIRPAGE."user/suspended/{$loggedEmail}");
        }
    }
}