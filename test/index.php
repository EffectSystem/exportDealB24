<?php

require_once __DIR__ . '/../crest/CRestPlus.php';

$resDeal = CRest::call(
    'crm.deal.list',
    [
        'filter' => [
            'TITLE' => 'Регистрация на интенсив (Pop-Up)'
        ],
        'select' => [
            'CONTACT_ID'
        ]
    ]
);

$resContact = CRest::call(
    'crm.contact.list',
    [
        'filter' => [
           'PHONE' => ''
        ],
        'select' => [
            'ID'
        ]
    ]
);






print_r($resContactes);