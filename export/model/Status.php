<?php

namespace export\model;

use export\crest\CRest;
use export\classes\Deb;

class Status
{

   public function getAll()
   {        
      $arCategory = [];
      $result = CRest::call('crm.dealcategory.list');
      if (!empty($result['result']))
      {
         Deb::print($result['result']);
      }
      // $result = CRest::call('crm.dealcategory.default.get');//get name default deal category
      // if (!empty($result['result']))
      // {
      //    $arCategory[$result['result']['ID']] = $result['result']['NAME'];
      // }

      // Deb::print($arCategory);
   }

}