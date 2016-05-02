<?php 

namespace App\Repository;

use Carbon\Carbon;
use App\Models\User;
use App\Services\ActivationService;
use App\Repository\RoleRepository;

class ActivationRepository
{
	private $user;
	private $activation;
    private $role;

	public function __construct(User $user, 
                                ActivationService $activation, 
                                RoleRepository $role)
	{
		$this->user = $user;
		$this->activation = $activation;
        $this->role = $role;
	}

	public function save($request)
	{
        $email = $request->get('emails');
        $findByEmail = $this->findByField('email', $email);
        
        if($findByEmail)
        {
            if($findByEmail->confirmation_code == null && $findByEmail->confirmed == 0) {
                return $this->resend($findByEmail);
            }

            return $findByEmail;
        }

        $confirmation_code  = $this->activation->createConfirmationCode();

        $this->user->name = $this->activation->getNameGravatar($email);
        $this->user->email =  $email;
        $this->user->avatar = $this->activation->imageAvatar($email);
        $this->user->confirmation_code = $confirmation_code;

        $user = $this->user->save();
        $this->user->roles()->attach(
            $this->role->roleId($request)
        );

    	$this->activation->sendMailActivation( $email, $confirmation_code );
        
        return $this->user;
	}

	public function update($request, $id)
	{
        $user = $this->user->find($id);
        $this->deleteConfirmationCode($user);

        $expire = $this->whereExpiredActivation($user);
        if(! $expire)
        {
            return $this->deleteUser($user);
        }

        $user->update(array_merge($request, ['confirmed' => 1]));

        return $user;
	}

    public function saveWithId($request)
    {
        $user = $this->user->find($request->get('id'));
        $user->name = $request->get('name');
        $user->password = $request->get('password');
        $user->confirmation_code = '';
        $user->confirmed = 1;
        $user->save();
    }

    public function resend($user)
    {
        return $this->activation->resendConfirmationCode($user);
    }

    protected function deleteConfirmationCode($user)
    {
        $user->confirmation_code = '';
        $user->save();
    }

    public function findByField($field, $data)
    {
    	return $this->user
            ->where($field, $data)
            ->first();
    }

    public function whereExpiredActivation($user)
    {
        return $user->where('created_at','>', Carbon::now()->subHours(24))->first();
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
}