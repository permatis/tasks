<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository 
{
	private $task;

	public function __construct(Task $task)
	{
		$this->task = $task;
	}



	public function save($request, $image_id)
	{
		$data = changeIdKeys(
            array_slice($request->all(), 0, -1), ['type']
        );

        return $this->task->create(
            array_merge($data, [
                'published' => 0,
                'user_id' 	=> user()->id,
                'status_id' => 1, 
                'image_id' 	=> $image_id
        ]));
	}

    public function joinTask($id)
    {
        return $this->find($id)
            ->userTask()->attach( user()->id );
    }

    public function findTaskByUserAndPublished()
    {
        return $this->task->where('user_id', user()->id)
            ->where('published', 1)->get();
    }

	public function updateRelationship($user_id, $task_id)
	{
        $tasks = $this->find($task_id);
        $pivotId = $this->getIdWherePivot($tasks, $user_id);
        $this->updateWithPivot(
        	$tasks, $this->userTaskData(1, $user_id, $task_id), $pivotId
        );

        return $tasks;
	}

    public function ifJoinedOrWorker($tasks, $status)
    {
        $array = [];
        foreach($tasks as $task) {
            $users = $task->userTask()->where('status', $status)->get();
            foreach ($users as $user) {
                $array[] = [
                    'user_id'   => $user->id, 
                    'task_id'   => $task->id,
                    'task_name' => $task->name, 
                    'email'     => $user->email
                ];
            }
        }
        return array_filter($array);
    }

    public function find($id, $key = '')
    {
        return (! empty($key) ) ? 
            $this->task->where($key, $id)->get() :
            $this->task->find($id);
    }

    public function userTaskData($status = 0, $user_id, $task_id)
    {
    	return [
            'status' 	=> $status,
            'user_id' 	=> $user_id,
            'task_id' 	=> $task_id
        ];
    }

    public function getIdWherePivot($model, $key)
    {
        return $model->userTask()
            ->where('user_id', $key)
            ->first()->pivot->id;
    }

    public function updateWithPivot($model, $data, $id)
    {
        return $model->userTask()
            ->newPivotStatement()
            ->where('id', $id)
            ->update($data);
    }
}