<?php

namespace App\Core;

use App\Models\Category;
use App\Models\User;

class Controller extends Render
{
    private array $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function isAjax(): bool
    {
        return
            isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    protected function treatImage(array $picture, string $folder): ?string
    {
        $type = $picture["type"];

        if (in_array($type, ["image/jpeg", "image/png"])) {
            $imageName = md5(time() . rand(0, 99999)) . ".jpg";
            move_uploaded_file(
                $picture["tmp_name"],
                DIRREQ . "public/img/{$folder}/{$imageName}"
            );

            list(
                $originalWidth,
                $originalHeight
                ) = getimagesize(
                DIRREQ . "public/img/{$folder}/{$imageName}"
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
                    DIRREQ . "public/img/{$folder}/{$imageName}"
                );
            } elseif ($type == "image/png") {
                $original = imagecreatefrompng(
                    DIRREQ . "public/img/{$folder}/{$imageName}"
                );
            } else {
                die(
                    json_encode([
                        "error" =>  "A imagem deve ser do tipo JPEG, JPG ou PNG"
                    ])
                );
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
                DIRREQ . "public/img/{$folder}/{$imageName}",
                80
            );

            return $imageName;
        }

        die(
            json_encode([
                "error" =>  "A imagem deve ser do tipo JPEG, JPG ou PNG"
            ])
        );
    }
}