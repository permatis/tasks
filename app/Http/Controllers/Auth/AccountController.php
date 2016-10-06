<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCompleteRequest;
use App\Repository\ActivationRepository;

class AccountController extends Controller
{
    private $activation;

    public function __construct(ActivationRepository $activation)
    {
        $this->activation = $activation;
    }

    /**
     * Verify confirmation code or token from email and then verify if exists.
     *
     * @param string $confirmation_code confirmation code from email
     *
     * @return array
     */
    public function verify($confirmation_code = '')
    {
        $user = $this->activation->findByField('confirmation_code', $confirmation_code);

        if (!$confirmation_code || !$user) {
            return redirect('/')
                ->withErrors(['emails' => ['Your token invalid, please register again.']]);
        }

        $expire = $this->activation->whereExpiredActivation($user);

        if (!$expire) {
            $this->activation->resend($user);
            $warning = 'This token expired. Please check your email address again.';

            return view('auth.verify', compact('warning'));
        }

        flash('You have successfully verified your account. Please complete your account!');

        return view('auth.verify', compact('user'));
    }

    public function resend()
    {
        $this->activation->resend(auth()->user());
        flash('Activation code have been sent. Please check your email address again.');

        return redirect()->back();
    }

    /**
     * Update account if valid token and complete form field.
     *
     * @param RegisterCompleteRequest $request request form input before validation
     * @param int                     $id
     *
     * @return Redirect
     */
    public function complete(RegisterCompleteRequest $request)
    {
        $this->activation->saveWithId($request);
        flash('You have successfully complete your account. Please login.');

        return redirect('/');
    }
}
