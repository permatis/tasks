<?php

namespace App\Services;

use Illuminate\Contracts\Mail\Mailer;

class ActivationService 
{
	private $mail;

	public function __construct(Mailer $mail)
	{
		$this->mail = $mail;
	}

	public function sendMailActivation($email, $confirmation_code)
    {
    	$data = ['confirmation_code' => $confirmation_code];

    	return $this->mail->send('auth.emails.verify', $data, function($message) use($email) {
            $message->to($email, $email)
                ->subject('Verify your email address');
        });
    }

    public function createConfirmationCode()
    {
    	return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function resendConfirmationCode($user)
    {
        $confirmation_code = $this->createConfirmationCode();
        $user->confirmation_code = $confirmation_code;
        $user->save();

        $this->sendMailActivation( $user->email, $confirmation_code );
        return $user;
    }

    protected function getGravatar($email)
    {
    	$content = @file_get_contents('https://www.gravatar.com/'.hashEmail($email).'.php');
    	
    	return ($content === FALSE) ? '' : $content;

    }

    public function getNameGravatar($email)
    {
    	$content = $this->getGravatar($email);

    	if($content) {
	    	$profile = unserialize($content);

			return ( is_array( $profile ) && isset( $profile['entry'] ) ) 
				? $profile['entry'][0]['displayName'] : '';
		}

		return '';
	}
}