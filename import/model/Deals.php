<?php

namespace model;

use classes\Deal;
use classes\Deb;
use crest\CRest;
use crest\CRestPlus;

class Deals extends Deal
{
    public function getList()
    {
       $res = CRest::call(
			'crm.deal.list',
			[
				// 'select' => [
				// 	'TITLE',
                //     'TYPE_ID',
                // ],
                'start' => 1
			]
		);

        //print_r($res);

        $countDeal = $res['total'];

        $start = 0;
        for($i = 0; $i < $countDeal/50; $i++){
            $deals[] = CRest::call(
                'crm.deal.list',
                [
                    // 'select' => [
                    //     'TITLE'
                    // ],
                    'start' => $start
                ]
            )['result'];

            $start +=50;
        }
        
        return $deals;
        
    }

}