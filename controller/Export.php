<?php

namespace controller;

use classes\Deb;
use model\Deals;

class Export
{
    public function run()
    {
        return self::prepareData();       

    }

    private function prepareData()
    {
        $deal = new Deals();
        $deals = $deal->getList(); 

        foreach($deals as $value) {
            Deb::print($deals);
        }

    }
}