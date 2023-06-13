<?php

namespace import\model;

use export\classes\Deb;
use import\crest\CRest;

class User
{
   public function getAll()
   {
        return CRest::call('user.get', []);
   }

   public function get($id)
   {
        return CRest::call('user.get', ['ID' => $id]);
   }

   public function add($data)
   {
         return CRest::call('user.add', $data);
   }

   public function addAll($users)
   {
     foreach($users['result'] as $val) {
          Deb::print($val);
          $res = $this->add(
               [
                    'NAME' => $val['NAME'],
                    'LAST_NAME' => $val['LAST_NAME'],
                    'SECOND_NAME' => $val['SECOND_NAME'],
                    'EMAIL' => $val['EMAIL'] ? $val['EMAIL'] : "{$val['ID']}@test.ru",
                    //'PERSONAL_PHOTO' => $val['PERSONAL_PHOTO'],
                    'PERSONAL_MOBILE' => $val['PERSONAL_MOBILE'],
                    'UF_DISTRICT' => $val['UF_DISTRICT'],
                    'UF_PHONE_INNER' => $val['UF_PHONE_INNER'],
                    'USER_TYPE' => $val['USER_TYPE'],
                    'UF_DEPARTMENT' => [1]
               ]
          );
          Deb::print($res);
          if (!$res['result']) {
               die;
          }
     }
   }
   //public function find()
}