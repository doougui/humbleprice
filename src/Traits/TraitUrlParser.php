<?php

namespace Src\Traits;

trait TraitUrlParser
{
    public function parseUrl(): array
    {
        $url = '/';

        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $url = array_values(array_filter(explode('/', $url)));

        return $url;
    }
}