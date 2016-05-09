<?php

namespace App\Repository;

use App\Repository\TaskRepository;
use App\Models\User;

class UserRepository
{
	private $task;
    private $user;

	public function __construct(TaskRepository $task, 
                                User $user)
	{
		$this->task = $task;
        $this->user = $user;
	}

    public function index()
    {
        $tasks = $this->task->find(1, 'published');
        
        return [
        	'tasks'    => $tasks,
            'joiners'   => $this->findByUserJoinOrNot(1)->get()
        ];
    }

    public function profile()
    {
        $user = $this->user->find(user()->id);

        return [
            'user' => $user,
            'pages' => $user->pages()->orderBy('updated_at', 'desc')->get(),
        ];
    }

    public function joins($model)
    {
        $joins = '<table class="table table-striped">';
        $joins .= '<thead><tr><th>Images</th><th>Link</th><th>Budget</th><th>Price</th></tr></thead><tbody><tr><td>';
        
        foreach($model->image as $img) {
            $joins .= '<img src="'.asset('img/tasks/'.$img->file).'"></td>';
        }

        $joins .= '<td><a href="'.$model->url.'">'. $model->name .'</a></td><td>'.$model->budget.'</td><td>'.$model->price.'</td>';
        $joins .= '</tbody></table>';

        return [
            'table' => $joins,
            'action' => url('user/join/'.$model->id)
        ];
    }

    public function find($id, $key = '')
    {
        return (! empty($key) ) ? 
            $this->user->where($key, $id)->get() :
            $this->user->find($id);
    }

    public function findByUserJoinOrNot($status)
    {
        return $this->find(user()->id)->taskUser()
            ->where('status', $status);
    }
}