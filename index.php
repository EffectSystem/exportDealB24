<?php

use export\classes\Deb;
use export\controller\Export;
use export\model\Deals;
use export\model\User;

require __DIR__."/vendor/autoload.php";

// die;

$exportDeal = new Deals();
//Deb::print($exportDeal->getList());
// die;

$import = new \import\model\Deals();
$import->addAll($exportDeal->getList());
die;


die;


$deals = new Export();
$listsDeal = $deals->run();

die;



// получаем всех пользователей
$exportUser = new User;
$users = $exportUser->getAll();
Deb::print($users);

// die;

// добовляем всех пользователей в новый портал
$importUser = new import\model\User();
$importUser->addAll($users);
die;


