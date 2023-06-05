<?php

use classes\Deb;
use controller\Export;

require __DIR__."/vendor/autoload.php";


$deals = new Export();
$listsDeal = $deals->run();

Deb::print($listsDeal);