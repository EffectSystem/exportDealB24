<?php

namespace export\model;

class Company extends \export\classes\Company
{
    public function getId($id)
    {
        return \export\model\Company::get($id);
    }

    public function getTitle($id)
    {
        $res = $this->getId($id);
        return $res['result']['TITLE'];
    }


}