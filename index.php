<?php

use classes\Deb;
use model\User;

require __DIR__."/vendor/autoload.php";


// $deals = new Export();
// $listsDeal = $deals->run();

$user = new User();
Deb::print($user->get(7));

//Deb::print($listsDeal);