<?php

namespace App\Repository;

use App\Repository\TaskRepository;

class ModeratorRepository 
{
	private $task;

	public function __construct(TaskRepository $task)
	{
		$this->task = $task;
	}

	public function index()
	{
		$unpublished = $this->task->find(0, 'published');
		$tasks = $this->task->find(1, 'published');

		return [
			'unpublished' => $unpublished,
			'tasks'		=> $tasks,
			'count'		=> $unpublished->count(),
			'joined' 	=> $this->task->ifJoinedOrWorker($tasks, 0),
			'workers' 	=> $this->task->ifJoinedOrWorker($tasks, 1)
		];
	}

}