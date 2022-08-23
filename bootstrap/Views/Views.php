<?php

namespace Bootstrap\Views;

use App\Exception\RouteException;
use Bootstrap\Settings;

class Views
{
    public function view(string $path, array $data): array
    {
        $path = str_replace(".", "/", $path);
        if (file_exists(Settings::views_path($path . ".peed.php"))){
            return [Settings::views_path($path . ".peed.php"), $data];
        }
        throw new RouteException("view not found");
    }
}