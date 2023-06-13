<?php

namespace controller;

use classes\Company;
use classes\Contact;
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

        Deb::print($deals);

        die;        


        foreach($deals as $value) {
            //Deb::print($value['CONTACT_ID']);
            if ($value['COMPANY_ID']) {
                $contact = Contact::get($value['CONTACT_ID']);
                $company = Company::get($value['COMPANY_ID']);
                Deb::print($company);
                die;
            }
          
        }
        


    }
}