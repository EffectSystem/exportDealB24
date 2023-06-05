<?php

require_once __DIR__ . '/../crest/CRestPlus.php';

class Notifications
{
	private $text;
	private $userId;

	function __construct($text = '', $userId)
	{
		$this->text= $text;
		$this->userId= $userId;
	}
	
	public function add()
	{
		return CRest::call(
		    'im.notify.personal.add', [
			'USER_ID' => $this->userId,
			'MESSAGE' => $this->text,
			'MESSAGE_OUT' => 'Уведомление',
			'TAG' => 'Уведомление',
			'SUB_TAG' => 'SUB|TEST',
			'ATTACH' => ''
		    ]
		);				
		
	}	
		
}
