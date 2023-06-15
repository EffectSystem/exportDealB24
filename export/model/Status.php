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
         $arCategory = array_column($result['result'], 'NAME', 'ID');
      }
      $result = CRest::call('crm.dealcategory.default.get');//get name default deal category
      if (!empty($result['result']))
      {
         $arCategory[$result['result']['ID']] = $result['result']['NAME'];
      }

      //Deb::print($arCategory);

      $resStaus = [];
      foreach ($arCategory as $id => $name) {
         if ($id > 0)
         {
             $entity_id = 'DEAL_STAGE_' . $id;
         }
         else
         {
             $entity_id = 'DEAL_STAGE';
         }
         //var_dump($entity_id);
         $resultDeal = CRest::call('crm.status.list', ['filter' => ['ENTITY_ID' => $entity_id]]);      
         $resStaus = array_merge($resStaus, $resultDeal['result']);
           
      }
      return $resStaus;     
   }
}