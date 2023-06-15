<?php

require __DIR__."/../../vendor/autoload.php";

use export\classes\Deb;
use export\model\Status;
use export\classes\Deal;
use import\classes\exportContact;
use import\model\Contact;


// $exportDeal = new export\classes\Deal();
// Deb::print($exportDeal->get(21));

// $exportContact = new export\classes\Contact();
// Deb::print($exportContact->get(19));

// $exportCompany = new export\classes\Company();
// Deb::print($exportCompany->get(19));



// $importUser = new \import\model\User();
// Deb::print($importUser->getIdByLastName('Байбурина'));
$exportUser = new \export\model\User();
Deb::print($exportUser->getLastNameAndName(7));


die;

// $importStatus = new \import\model\Status();
//Deb::print($importStatus->getId(5, 'C5:NEW'));
// Deb::print($importStatus->getAll());

// die;


// $exportStatus = new Status();
// $arrStatus = $exportStatus->getAll();
// Deb::print($exportStatus->getAll());

// Deb::print("===============================================");

// $importStatus = new \import\model\Status();
// Deb::print($importStatus->getAll());

//die;



// уделаение всех пользовательских статусов из воронки 
$importStatus = new \import\model\Status();
Deb::print($importStatus->deleteAll(0));
$importStatus->deleteAll(1);
$importStatus->deleteAll(3);
$importStatus->deleteAll(5);
$importStatus->deleteAll(7);
//die;




// получение всех воронок и статусов сделок
$exportStatus = new Status();
$arrStatus = $exportStatus->getAll();

// добовление всех статус в воронки, воронки предварительно должны быть созданы в портале и id их должны совпадать с оригинальными
$importStatus = new \import\model\Status();
foreach($arrStatus as $key => $val) {
	Deb::print($val);	

    $idStatus = $importStatus->getId($val['CATEGORY_ID'], $val['STATUS_ID']);
    if ($idStatus) {
        $resUpdate = $importStatus->update(
            [
                'ID' => $idStatus,
                'fields' => [
                    // 'ENTITY_ID' => $val['ENTITY_ID'],
                    // 'STATUS_ID' => $val['STATUS_ID'],
                    'NAME' => $val['NAME'],
                    'SORT' => $val['SORT'],
                    'COLOR' => $val['COLOR'],
                    'SEMANTICS' => $val['SEMANTICS'],
                    // 'CATEGORY_ID' => $val['CATEGORY_ID'],
                ]
            ]
        );

        if (!$resUpdate['result']) {
            $logUpdate = [
                'error' => $resUpdate,
                'data' => $val
            ];
            Deb::log($logUpdate, $_SERVER['DOCUMENT_ROOT'].'/import/logs/errorUpdateStatus.log', 'Ошибки обновления статусов');
        }        
    } else {

        $res = $importStatus->add($val);

        if (!$res['result']) {
            $logAdd = [
                'error' => $res,
                'data' => $val
            ];
            Deb::log($logAdd, $_SERVER['DOCUMENT_ROOT'].'/import/logs/errorStatus.log', 'Ошибки добавления статусов');
        }       
    } 		
}

die;



// $exportStatus = new Status;
// Deb::print($exportStatus->getAll());

$importStatus = new \import\model\Status();
// Deb::print($importStatus->getAll());

// die;

Deb::print($importStatus->update(
    [
        'id' => 193,
        'fields' => [
            'SORT' => 130
        ]
    ]
));
