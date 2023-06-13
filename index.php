<?php

use export\classes\Deb;
use export\controller\Export;
use export\model\User;
use export\model\Status;

require __DIR__."/vendor/autoload.php";


$status = new Status();
$status->getAll();

die;


$deals = new Export();
$listsDeal = $deals->run();

die;



// получеме всех пользователей
$exportUser = new User;
$users = $exportUser->getAll();
Deb::print($users);

// die;

// добовляем всех пользователей в новый портал
$importUser = new import\model\User();
$importUser->addAll($users);
die;


$arCategory = [];
$result = CRest::call('crm.dealcategory.list');
if (!empty($result['result']))
{
	$arCategory = array_column($result['result'], 'NAME', 'ID');
}
$result = CRest::call('crm.dealcategory.default.get');//get name default deal category
if (!empty($result['result']))
{
	$arCategory[$result['result']['ID']] = $result['result']['NAME'];
}

//Deb::print($arCategory);

require __DIR__.'/test.php';