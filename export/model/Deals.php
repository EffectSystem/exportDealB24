<?php

namespace export\model;

use export\classes\Deal;
use export\classes\Deb;
use export\crest\CRest;
use crest\CRestPlus;
use export\classes\Deb as ClassesDeb;
use import\classes\Deb as ImportClassesDeb;

/**
 * Класс для работы со сделками
 */
class Deals extends Deal
{
    /**
     * @return array
     */
    public function getList()
    {
        $res = CRest::call(
            'crm.deal.list',
            [
                'start' => 1
            ]
        );

        $countDeal = $res['total'];

        $arrDeals = [];
        $start = 0;
        for ($i = 0; $i < $countDeal / 50; $i++) {
            $deals = CRest::call(
                'crm.deal.list',
                [
                    'start' => $start
                ]
            )['result'];

            $arrDeals = array_merge($arrDeals, $deals);
            $start += 50;
        }
        return $arrDeals;
    }
}
