<?php

namespace App\Repository;

use App\Models\StatusTask;

class StatusRepository
{
    private $status;
    private $task;

    public function __construct(StatusTask $status,
                                TaskRepository $task)
    {
        $this->status = $status;
        $this->task = $task;
    }

    public function all()
    {
        return $this->status->all();
    }

    public function updateRelationship($id, $request)
    {
        return $this->task->find($id)
            ->update($request);
    }

    public function changeStatusWithProgress($tasks)
    {
        $status = $this->findNameByLike('progress');

        return ($status) ?
            $tasks->update(['status_id' => $status->id]) : '';
    }

    public function findNameByLike($key)
    {
        return $this->status
            ->where('name', 'LIKE', '%'.$key.'%')
            ->first();
    }
}
