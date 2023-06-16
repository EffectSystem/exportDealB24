<?php

namespace export\model;

use export\crest\CRest;

class TimeLine
{
    public function getList($data)
    {
        return CRest::call('crm.timeline.comment.list', $data);
    }

    // $enttityType = 'deal', 'contact', 'company', 'lead'
    public function getAllComment($id, $enttityType)
    {
       return $this->getList(
            [
                'filter' => [
                    'ENTITY_ID' => $id,
                    'ENTITY_TYPE' => $enttityType
                ]
            ]
        );
    }

}