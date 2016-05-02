<?php

namespace App\Http\Controllers;

use App\Repository\TaskRepository;
use App\Repository\UserRepository;

class UserController extends Controller
{
    private $task;
    private $user;

    public function __construct(TaskRepository $task, UserRepository $user)
    {
        $this->middleware('activation');
        $this->task = $task;
        $this->user = $user;
    }

    public function index()
    {
        return view('user.view_task')
            ->with( $this->user->index() );
    }

    public function join($id)
    {
        $this->task->joinTask($id);

        return redirect('user');
    }
}
