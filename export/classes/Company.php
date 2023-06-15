<?php

namespace export\classes;

use export\crest\CRest;

class Company
{
	public static function get($id)
    {
        return CRest::call(
			'crm.company.get',
			[
				'id' => $id
			]
		);
    }
}
