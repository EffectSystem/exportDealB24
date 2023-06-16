<?php

namespace import\model;

use import\classes\Deb;
use import\crest\CRest;

class TimeLine
{
    public function getList($data)
    {
        return CRest::call('crm.timeline.comment.list', $data);
    }

    public function add($data)
    {
        return CRest::call('crm.timeline.comment.add', $data);
    }

    public function addAll($idDdeal, $entityType, $data)
    {
        $exportUser = new \export\model\User();
        $importUser = new \import\model\User();

        foreach ($data['result'] as $val) { 
            $val['ENTITY_ID'] = $idDdeal;
            $val['ENTITY_TYPE'] = $entityType;          
            $importIdUser = $importUser->getIdByLastName($exportUser->getLastNameAndName($val['AUTHOR_ID']));
            $val['AUTHOR_ID'] = $importIdUser;
           $res = $this->add(['fields' => $val]
        );
            if (!$res['result']) {
                Deb::log(['error' => $res, 'data' => $val], $_SERVER['DOCUMENT_ROOT']."/import/logs/errorAddComment.log");
            }
        }
    }

}