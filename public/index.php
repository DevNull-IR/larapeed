<?php
//echo "<pre>";
//var_dump($_SERVER);

use Spatie\Ignition\Ignition;

require_once __DIR__ . "/../vendor/autoload.php";

Ignition::make()->register();

\Boot\Kernel\Kernel::run();

