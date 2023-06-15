<?php

namespace export\model;

use export\crest\CRest;

class User
{
//    public function find(array $params)
//    {
//     //CRest::call('')
//    }

   public function getAll()
   {
        return CRest::call('user.get', []);
   }

   public function get($id)
   {
        return CRest::call('user.get', ['ID' => $id]);
   }

   public function find($search)
   {
     return CRest::call('user.search', [
          'FILTER' => [
               'FIND' => $search
          ]
     ]);
   }

   public function getLastNameAndName($id)
   {
     $res = $this->get($id)['result'][0];
     return "{$res['LAST_NAME']} {$res['NAME']}";
   }
}