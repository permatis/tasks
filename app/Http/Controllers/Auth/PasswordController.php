<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgotPasswordRequest;

class PasswordController extends Controller
{
    private $user;
    private $mailer;

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(PasswordBroker $passwords, 
                                User $user)
    {
        $this->middleware('guest');
        $this->passwords = $passwords;
        $this->user = $user;
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validation = Validator::make(
            $request->all(), [ 'email' => 'required']
        );

        if ($validation->fails()) {
            $this->throwValidationException(
                $request, $validation
            );
        }

        $response = $this->passwords->sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
           case Password::RESET_LINK_SENT:
           flash('Password reset link has send. Please check your email.');
            return response()->json([
                'redirect' => url()->previous()
            ]);
               // return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
                if( $request->isXmlHttpRequest() ) {
                    return response()->json( [
                        'email' => ['These credentials do not match our records.']
                    ], 422);
                }
       }

    }

    public function reset(ForgotPasswordRequest $request)
    {
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = $this->passwords->reset($credentials, function($user, $password) {
            $user->update(['password' => $password]);
            auth()->login($user);
        });

        switch ($response)
        {
            case PasswordBroker::PASSWORD_RESET:
                return redirect('/');

            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }

    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
    }
}
