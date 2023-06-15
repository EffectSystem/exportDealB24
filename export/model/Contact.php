<?php

namespace export\model;

class Contact extends \export\classes\Contact
{
    public function getId($id)
    {
        return \export\model\Contact::get($id);
    }


}