<?php

namespace App\Repository;

use App\Repository\TaskRepository;
use App\Models\User;

class UserRepository
{
	private $task;
    private $user;

	public function __construct(TaskRepository $task, 
                                User $user)
	{
		$this->task = $task;
        $this->user = $user;
	}

    public function index()
    {
        $tasks = $this->task->find(1, 'published');
        
        return [
        	'tasks'    => $tasks,
            'joiners'   => $this->findByUserJoinOrNot(1)->get()
        ];
    }

    public function find($id, $key = '')
    {
        return (! empty($key) ) ? 
            $this->user->where($key, $id)->get() :
            $this->user->find($id);
    }

    public function findByUserJoinOrNot($status)
    {
        return $this->find(user()->id)->taskUser()
            ->where('status', $status);
    }
}