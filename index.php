<?php

use export\classes\Deb;
use export\controller\Export;
use export\model\User;
use export\model\Status;

require __DIR__."/vendor/autoload.php";

// получение всех воронок и статусов сделок
$exportStatus = new Status();
$arrStatus = $exportStatus->getAll();

// добовление всех статус в воронки, воронки предварительно должны быть созданы в портале и id их должны совпадать с оригинальными
$importStatus = new \import\model\Status();
foreach($arrStatus as $val) {
	Deb::print($val);	
	$res = $importStatus->add($val);
	if (!$res['result']) {
		$log = [
			'error' => $res,
			'data' => $val
		];
		Deb::log($log, __DIR__.'/import/logs/errorStatus.log', 'Ошибки добавления статусов');
	}	
}

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


