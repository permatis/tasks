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
		
		$joined = [];
		foreach($tasks as $task) {
			foreach ($task->userTask()->where('status', 0)->get() as $user) {
				$joined[] = [
					'user_id' => $user->id, 
					'task_id'	=> $task->id,
					'task_name' => $task->name, 
					'email' => $user->email
				];
			}
		}
		
		return [
			'tasks' 	=> $tasks,
			'joined' 	=> $this->task->ifJoinedOrWorker($tasks, 0),
			'workers' 	=> $this->task->ifJoinedOrWorker($tasks, 1)
		];

	}
}