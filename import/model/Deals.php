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
            //Deb::print($value);
        
            if ($i == 500) {
                return;
            }
            

            $importContact = new Contact();
            $contactIdImport = $importContact->getId($value['CONTACT_ID']); 
            $value['CONTACT_ID'] = $contactIdImport; 

            $importCompany= new Company();
            // $companyIdImport = $importCompany->getId($value['COMPANY_ID']); 
            // if ($companyIdImport) {
            //     $value['COMPANY_ID'] = $companyIdImport; 
            // }

            $exportCompany= new \export\model\Company();
            $exportCompanyTitle = $exportCompany->getTitle($value['COMPANY_ID']);           

            $value['COMPANY_ID'] = '';
            if ($exportCompanyTitle) {
                $companyIdImport = $importCompany->getIdByTitle($exportCompanyTitle);
                $value['COMPANY_ID'] = $companyIdImport; 
            }

            Deb::print($value);
            


            

            if ($value['COMPANY_ID'] == 981) {
                die;
            }
            
            $importUsers = new User();
            $exportUsers = new \export\model\User();
            $expotrLastNameAndName = $exportUsers->getLastNameAndName($value['ASSIGNED_BY_ID']);          
            $value['ASSIGNED_BY_ID'] = $importUsers->getIdByLastName($expotrLastNameAndName);

            $idDealImport = self::add($value)['result'];
            $exportTimeLine = new \export\model\TimeLine();
            $exportTimeLineComment =  $exportTimeLine->getAllComment($value['ID'], 'deal');
            // Deb::print($idDealImport);
            // Deb::print($exportTimeLine->getAllComment($value['ID'], 'deal'));
            

            $importTimeLine = new \import\model\TimeLine();
            $resAddTimeLine = $importTimeLine->addAll($idDealImport, 'deal', $exportTimeLineComment);

            $exportTasks = new \export\model\Task();
            $resExportTasks = $exportTasks->getByIdDeal($value['ID']);

            $importTasks = new \import\model\Task();
            $importTasks->addAllForDeal($idDealImport, $resExportTasks);
    

            //Deb::print($resExportTasks);
            
           

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