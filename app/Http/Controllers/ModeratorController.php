<?php

namespace App\Http\Controllers;

use App\Repository\ModeratorRepository;
use App\Repository\StatusRepository;
use App\Repository\TaskRepository;

class ModeratorController extends Controller
{
    private $moderator;
    private $task;
    private $status;

    public function __construct(ModeratorRepository $moderator,
                                TaskRepository $task,
                                StatusRepository $status)
    {
        $this->moderator = $moderator;
        $this->task = $task;
        $this->status = $status;
    }

    public function index()
    {
        return view('moderator.tasks')
            ->with(array_merge(
                $this->moderator->index(),
                ['stat' => dropdowns($this->status->all())]
            ));
    }

    public function publishTask($id)
    {
        $task = $this->task->find($id);
        $task->update(['published' => 1]);

        return redirect('moderator');
    }

    public function tasks()
    {
        $tasks = $this->task->where('published', 1)->get();
        $count = $this->task->where('published', 0)->count();

        return view('moderator.tasks', compact('tasks', 'count'));
    }

    public function joiner($user_id, $task_id)
    {
        $tasks = $this->task->updateRelationship($user_id, $task_id);
        $this->status->changeStatusWithProgress($tasks);

        return redirect('moderator');
    }

    public function changeStatusTask($id)
    {
        $this->status->updateRelationship($id, request()->all());

        return redirect('moderator');
    }
}
