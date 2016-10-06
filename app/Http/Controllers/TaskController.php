<?php

namespace App\Http\Controllers;

use App\Models\StatusTask;
use App\Models\Task;

class TaskController extends Controller
{
    private $task;
    private $status;
    private $roles;

    public function __construct(Task $task, StatusTask $status)
    {
        $this->task = $task;
        $this->status = $status;
    }

    public function join($id)
    {
        $this->findIdTask($id)->userTask()->detach();
        $this->findIdTask($id)->userTask()->attach([3]);

        return redirect('user');
    }

    public function getTaskStatus($id)
    {
        $task = $this->findIdTask($id);
        $status = $this->dropdowns($this->status);
        $user = $user;

        return view('tasks.change_status', compact('task', 'status', 'user'));
    }

    public function putTaskStatus($id)
    {
        $this->findIdTask($id)->update(request()->all());

        return redirect();
    }

    private function findIdTask($id)
    {
        return $this->task->find($id);
    }

    private function getIdWherePivot($model, $key)
    {
        return $model->userTask()
            ->where('user_id', $key)
            ->first()->pivot->id;
    }

    private function updateWithPivot($model, $data, $id)
    {
        return $model->userTask()
            ->newPivotStatement()
            ->where('id', $id)
            ->update($data);
    }

    private function dropdowns($model)
    {
        $type = [];
        foreach ($model->all() as $key => $val) {
            $type[$val->id] = $val->name;
        }

        return $type;
    }
}
