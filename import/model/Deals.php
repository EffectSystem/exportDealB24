<?php

namespace import\model;

use import\classes\Deal;
use import\classes\Deb;
use import\crest\CRest;
use import\crest\CRestPlus;

class Deals extends Deal
{
    // public function getList()
    // {
    //    $res = CRest::call(
	// 		'crm.deal.list',
	// 		[
	// 			// 'select' => [
	// 			// 	'TITLE',
    //             //     'TYPE_ID',
    //             // ],
    //             'start' => 1
	// 		]
	// 	);

    //     //print_r($res);

    //     $countDeal = $res['total'];

    //     $start = 0;
    //     for($i = 0; $i < $countDeal/50; $i++){
    //         $deals[] = CRest::call(
    //             'crm.deal.list',
    //             [
    //                 // 'select' => [
    //                 //     'TITLE'
    //                 // ],
    //                 'start' => $start
    //             ]
    //         )['result'];

    //         $start +=50;
    //     }        
    //     return $deals;        
    // }



    public function addAll($deals)
    {
        $i = 0;
        foreach($deals as $value) {
            Deb::print($value);
        
            if ($i == 500) {
                return;
            }

            $importContact = new Contact();
            $contactIdImport = $importContact->getId($value['CONTACT_ID']); 
            $value['CONTACT_ID'] = $contactIdImport; 
            
            $importUsers = new User();
            $exportUsers = new \export\model\User();
            $expotrLastNameAndName = $exportUsers->getLastNameAndName($value['ASSIGNED_BY_ID']);          
            $value['ASSIGNED_BY_ID'] = $importUsers->getIdByLastName($expotrLastNameAndName);

            Deb::print(self::add($value));
            // if ($value['COMPANY_ID']) {
            //     $contact = Contact::get($value['CONTACT_ID']);
            //     $company = Company::get($value['COMPANY_ID']);
            //     Deb::print($company);
            //     die;
            // }

            $i++;
          
        }
    }

}