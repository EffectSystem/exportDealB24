<?php

//Load Composer's autoloader
require __DIR__ . '/Email.php';

$email = new Email();
$email->send('Error ID', 'Указанного id нет');
