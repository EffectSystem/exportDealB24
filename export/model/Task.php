<?php

namespace export\model;

use export\crest\CRest;

class Task 
{
    public function get()
    {
        //
    }

    public function getByIdDeal($idDeal)
    {
        return CRest::call('tasks.task.list', [
            'filter' => [
                'UF_CRM_TASK' => "D_".$idDeal
            ]
        ]);
    }
}