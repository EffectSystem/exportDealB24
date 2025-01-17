<?php

namespace import\model;

use export\classes\Deb;
use import\crest\CRest;

/**
 * [Description Contact]
 */
class Contact
{
    /**
     * [Description for getId]
     *
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getId($id)
    {
        // получаем по id контакта email и номер телефона
        $res = \export\model\Contact::get($id);
        //Deb::print($res);
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

        return  $this->getList(
            [
            'filter' => [
                'LAST_NAME' => $res['result']['LAST_NAME'],
                'NAME' => $res['result']['NAME'],
            ]
            ]
        )['result'][0]['ID'];


    }

    /**
     * [Description for findByEmail]
     *
     * @param mixed $email
     * 
     * @return [type]
     */
    public static function findByEmail($email)
    {
        $res = \import\crest\CRest::call(
            'crm.duplicate.findbycomm', [
            'type' => 'EMAIL',
            'entity_type' => 'CONTACT',
            'values' => [$email]
            ]
        );
        return $res['result']['CONTACT'][0] ?? null;
    }

    /**
     * [Description for findByPhone]
     *
     * @param mixed $phone
     * 
     * @return [type]
     * 
     */
    public static function findByPhone($phone)
    {
        $res = \import\crest\CRest::call(
            'crm.duplicate.findbycomm', [
            'type' => 'PHONE',
            'entity_type' => 'CONTACT',
            'values' => [$phone]
            ]
        );
        return $res['result']['CONTACT'][0] ?? null;
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
        return CRest::call('crm.contact.list', $data);
    }

}