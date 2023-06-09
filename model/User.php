<?php

namespace model;

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
        $arrUsers = $this->getAll()['result'];
        foreach($arrUsers as $user) {
            
            if ($id == $user['ID']) {
                return $user;
            }
        }
   }

   //public function find()
}