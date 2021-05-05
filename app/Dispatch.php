<?php

namespace App;

use Src\Traits\TraitUrlParser;

class Dispatch
{
    private array $prefixes;

    use TraitUrlParser;

    public function run(): void
    {
        $url = $this->parseUrl();
        $params = [];

        if (! empty($url)) {
            $currentController = "{$url[0]}Controller";
            array_shift($url);

            if (isset($url[0]) && ! empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = "index";
            }

            if (count($url) > 0) {
                $params = $url;
            }
        } else {
            $currentController = "HomeController";
            $currentAction = "index";
        }

        $currentController = ucfirst($currentController);
        $prefix = "\App\Controllers\\";

        if (! file_exists(dirname(__DIR__)."/app/Controllers/{$currentController}.php") ||
            ! method_exists($prefix.$currentController, $currentAction))
        {
            $currentController = "NotfoundController";
            $currentAction = "index";
        }

        $newController = $prefix.$currentController;

        $controller = new $newController();

        set_error_handler(function () {
            $currentController = "NotfoundController";
            $currentAction = "index";

            $prefix = "\App\Controllers\\";

            $newController = $prefix.$currentController;

            $controller = new $newController();
            call_user_func_array([$controller, $currentAction], []);
        });

        call_user_func_array([$controller, $currentAction], $params);

        restore_error_handler();
    }
}