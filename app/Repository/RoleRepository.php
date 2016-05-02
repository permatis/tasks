<?php

namespace App\Repository;

use App\Models\Role;

class RoleRepository
{
	private $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

    public function roleId($request)
    {
        return ($request->get('roles')) 
            ? $this->findRoleId($request->get('roles')) 
            : $this->roleUserId(); 
    }

    protected function findRoleId($name)
    {
        return $this->role->where('name', $name)
            ->first()->id;
    }

    protected function roleUserId()
    {
    	return $this->role->where('name', 'user')
            ->first()->id;
    }
}