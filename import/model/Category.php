<?php

namespace model;

use crest\CRest;

class Category
{


   public function get($id)
   {
        return CRest::call('crm.status.list', []);
   }

}