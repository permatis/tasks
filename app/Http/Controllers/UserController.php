<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageCreateRequest;
use App\Models\Page;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;

class UserController extends Controller
{
    private $task;
    private $user;
    private $page;

    public function __construct(TaskRepository $task,
                                UserRepository $user,
                                Page $page)
    {
        $this->middleware('activation');
        $this->task = $task;
        $this->user = $user;
        $this->page = $page;
    }

    public function index()
    {
        return view('user.view_task')
            ->with($this->user->index());
    }

    public function join($id)
    {
        $this->task->joinTask($id, request()->get('comment'));

        return redirect('user');
    }

    public function tasks()
    {
        $task = $this->task->find(request()->get('task_id'));

        return $this->user->joins($task);
    }

    public function profile()
    {
        return view('user.profile')
            ->with($this->user->profile());
    }

    public function postPages(PageCreateRequest $request)
    {
        $pages = $this->page->create($request->all());
        $pages->users()->attach([user()->id]);

        return redirect('user/profile');
    }
}
