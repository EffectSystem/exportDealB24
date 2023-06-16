<?php

namespace import\model;

use export\classes\Deb;

class Contact
{
    public function getId($id)
    {
        // получаем по id контакта email и номер телефона
        $res = \export\model\Contact::get($id);
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

    public static function findByEmail($email)
	{
		$res = \import\crest\CRest::call('crm.duplicate.findbycomm', [
			'type' => 'EMAIL',
			'entity_type' => 'CONTACT',
			'values' => [$email]
		]);
		return $res['result']['CONTACT'][0] ?? null;
	}

    public static function findByPhone($phone)
	{
		$res = \import\crest\CRest::call('crm.duplicate.findbycomm', [
			'type' => 'PHONE',
			'entity_type' => 'CONTACT',
			'values' => [$phone]
		]);
		return $res['result']['CONTACT'][0] ?? null;
	}

}