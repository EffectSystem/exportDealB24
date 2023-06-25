<?php

require __DIR__."/../../vendor/autoload.php";

use export\classes\Deb;
use export\model\Status;
use export\classes\Deal;
use export\model\TimeLine;
use import\classes\exportContact;
use import\model\Contact;


// $importCompany = new \import\model\Company();
// $CompanyIdImport = $importCompany->getId(15); 

// Deb::print($CompanyIdImport);

// die;

$importContact = new \import\model\Contact();
$contactIdImport = $importContact->getId(5); 
Deb::print($contactIdImport);

die;

$importCompany = new \import\model\Company();

Deb::print($importCompany->getIdByTitle(''));

die;



// $exportTasks = new \export\model\Task();
// $resTasks = $exportTasks->getByIdDeal(6945);

$exportDeal = new export\classes\Deal();
Deb::print($exportDeal->get(17));

die;

$importContact = new Contact();
$contactIdImport = $importContact->getId(11); 


Deb::print($contactIdImport);

die;


Deb::print($contactIdImport);

die;



$importTasks = new \import\model\Task();
$res = $importTasks->addAllForDeal(3447, $resTasks);
Deb::print($res);

die;


$exportUser = new \export\model\User();


$importUser =  new \import\model\User();
Deb::print($importUser->getIdByLastName($exportUser->getLastNameAndName(7)));

die;

$exportTimeLine = new TimeLine();
$res = $exportTimeLine->getAllComment(21, 'deal');

Deb::print($res);

die;

// $importTimeLine = new \import\model\TimeLine();
// $res = $importTimeLine->add(
//     [
//         'fields' => [
//             'ENTITY_ID' => 3237,
//             'ENTITY_TYPE' => 'deal',
//             'COMMENT' => "Новый комментарий"
//         ]
//     ]
// );

// $exportDeal = new export\classes\Deal();
// Deb::print($exportDeal->get(21));

// $exportContact = new export\classes\Contact();
// Deb::print($exportContact->get(19));

// $exportCompany = new export\classes\Company();
// Deb::print($exportCompany->get(19));



// $importUser = new \import\model\User();
// Deb::print($importUser->getIdByLastName('Байбурина'));


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
