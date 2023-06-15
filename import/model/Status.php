<?php

namespace import\model;

use import\crest\CRest;
use import\classes\Deb;

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

      Deb::print($arCategory);

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
         
         if (!empty($resultDeal['result'])) {
            Deb::print($resultDeal);
         }
           
    }            
     
   }

   public function add($val)
   {
      return  CRest::call('crm.status.add', [
            'fields' => [
                'ENTITY_ID' => $val['ENTITY_ID'],
                'STATUS_ID' => $val['STATUS_ID'],
                'NAME' => $val['NAME'],
                'SORT' => $val['SORT'],
                'COLOR' => $val['COLOR'],
                'SEMANTICS' => $val['SEMANTICS'],
                'CATEGORY_ID' => $val['CATEGORY_ID'],
            ]
        ]);
   }

   public function addAll($data)
   {

    $idCategory = 0;
      return  CRest::call('crm.status.add', [
            'fields' => [
                'ENTITY_ID' => $idCategory > 0 ? 'DEAL_STAGE_'.$idCategory : 'DEAL_STAGE',
                'STATUS_ID' => 'PREPARATION1',
                'NAME' => 'Необработанная заявка2',
                'SORT' => 20,
                'COLOR' => '#2fc6f6',
                'CATEGORY_ID' => $idCategory
            ]
        ]);
   }

   public function update(array $data)
   {
      return CRest::call('crm.status.update', $data);
   }

   public function list($data)
   {
      return CRest::call('crm.status.list', $data);
   }

   public function getId($entityId, $statusID)
   {
      $res = $this->list(
         [
            'ID' => $entityId,
            'filter' => 
                [
                    'ENTITY_ID' => $entityId > 0 ? "DEAL_STAGE_{$entityId}" : 'DEAL_STAGE',
                    'STATUS_ID' => $statusID
                ]
         ]
      );

      return $res['result'][0]['ID'];      
   }

   public function delete($id)
   {
      return CRest::call('crm.status.delete', ['ID' => $id]);
   }

   // Удалеяет все статусы из воронки кроме системных - их удалить нельзя
   public function deleteAll($entityId)
   {
      $arrStatuses = $this->list(
         [
            'ID' => $entityId,
            'filter' => 
                [
                    'ENTITY_ID' => $entityId > 0 ? "DEAL_STAGE_{$entityId}" : 'DEAL_STAGE',
                    'SYSTEM' => 'N'
                ]
         ]
      );

      foreach ($arrStatuses['result'] as $val) {
         $res = $this->delete($val['ID']);
         if (!$res['result']) {
            Deb::print($res);
         }
      }
   }
}