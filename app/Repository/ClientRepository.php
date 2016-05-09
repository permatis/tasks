<?php

namespace App\Repository;

use App\Repository\TaskRepository;

class ClientRepository
{
	private $task;

	public function __construct(TaskRepository $task)
	{
		$this->task = $task;
	}

	public function index()
	{
		$tasks = $this->task->find(user()->id, 'user_id');
		
		return [
			'tasks' 	=> $tasks,
			'joined' 	=> $this->task->ifJoinedOrWorker($tasks, 0),
			'workers' 	=> $this->task->ifJoinedOrWorker($tasks, 1)
		];

	}
}