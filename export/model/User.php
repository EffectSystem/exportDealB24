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

   //public function find()
}