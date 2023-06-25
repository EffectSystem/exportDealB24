<?php

namespace import\model;

use export\classes\Deb;
use import\crest\CRest;

class Company
{
    public function getId($id)
    {
        // получаем по id контакта email и номер телефона
        $res = \export\model\Company::get($id);
        Deb::print($res);
        $arrPhones = $res['result']['PHONE'] ?? null;
        $arrEmails = $res['result']['EMAIL'] ?? null;

        if ($arrEmails) {
            foreach ($arrEmails as $val) {
                $resFind = $this->findByEmail($val['VALUE']);
                if ($resFind) {
                    return $resFind;
                }
            }
        }       

        if ($arrPhones) {
            foreach ($arrPhones as $val) {
                $resFind = $this->findByPhone($val['VALUE']);
                if ($resFind) {
                    return $resFind;
                }
            }
        }
    }

    /**
     * [Description for findByEmail]
     *
     * @param mixed $email
     * 
     * @return [type]
     * 
     */
    public static function findByEmail($email)
    {
        $res = \import\crest\CRest::call(
            'crm.duplicate.findbycomm', [
            'type' => 'EMAIL',
            'entity_type' => 'COMPANY',
            'values' => [$email]
            ]
        );
        return $res['result']['COMPANY'][0] ?? null;
    }

    public static function findByPhone($phone)
    {
        $res = \import\crest\CRest::call(
            'crm.duplicate.findbycomm', [
                'type' => 'PHONE',
                'entity_type' => 'COMPANY',
                'values' => [$phone]
            ]
        );
        return $res['result']['COMPANY'][0] ?? null;
    }

    public function getIdByTitle($title)
    {
        return $this->getList(
            [
                'filter' => [
                    'TITLE' => $title
                ]
            ]
        )['result'][0]['ID'];
    }

    /**
     * [Description for getList]
     *
     * @param mixed $data
     * 
     * @return [type]
     * 
     */
    public function getList($data)
    {
        return CRest::call('crm.company.list', $data);
    }



}