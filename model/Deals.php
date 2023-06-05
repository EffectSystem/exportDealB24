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
       return CRest::call(
			'crm.deal.list',
			[
				// 'select' => [
				// 	'TITLE',
                //     'TYPE_ID',
                // ],
                'start' => 50
			]
		);

        Deb::print($res['result']);

        die;

        



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