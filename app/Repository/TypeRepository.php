<?php

namespace App\Repository;

use App\Models\TypeTask;

class TypeRepository
{
	private $type;

	public function __construct(TypeTask $type)
	{
		$this->type = $type;
	}
}