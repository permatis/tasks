<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksCreateRequest;
use App\Models\Task;
use App\Models\TypeTask;
use App\Repository\TaskRepository;
use App\Repository\ImageRepository;
use App\Repository\StatusRepository;
use App\Repository\ClientRepository;

class ClientController extends Controller
{
    private $tasks;
    private $images;
    private $status;
    private $type;
    private $client;

    public function __construct(
        TaskRepository $tasks,
        ImageRepository $images,
        StatusRepository $status, 
        TypeTask $type,
        ClientRepository $client
    )
    {
        $this->middleware('activation');
        $this->tasks = $tasks;
        $this->images = $images;
        $this->status = $status;
        $this->type = $type;
        $this->client = $client;
    }

    public function index()
    {
        return view('client.view_task')
            ->with( array_merge(
                $this->client->index(), 
                [ 'stat' => dropdowns($this->status->all()) ]
            ));
    }

    public function create()
    {
        $types = dropdowns($this->type->all());
        return view('client.create_task', compact('types'));
    }

    public function store(TasksCreateRequest $request)
    {
        $images = $this->images->save($request);
        $this->tasks->save($request, $images->id);

        return redirect('client');
    }

    public function joiner($user_id, $task_id)
    {
        $tasks = $this->tasks->updateRelationship($user_id, $task_id);
        $this->status->changeStatusWithProgress($tasks);

        return redirect('client');
    }

    public function changeStatusTask($id)
    {   
        $this->status->updateRelationship($id, request()->all());
        return redirect('client');
    }

}
