<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterEmailRequest;
use App\Models\User;
use App\Repository\ActivationRepository;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    private $activation;

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationRepository $activation)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->activation = $activation;
    }

    /**
     * Login roles for validation.
     *
     * @return array
     */
    protected function loginRoles()
    {
        return [
            'email'     => 'required',
            'password'  => 'required',
        ];
    }

    /**
     * Process login to applications for user or client.
     *
     * @param Request $request request form input
     *
     * @return json
     */
    public function login(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            $this->loginRoles()
        );

        if ($validation->fails()) {
            $this->throwValidationException(
                $request, $validation
            );
        }

        if (auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'redirect' => url()->previous(),
            ]);
        }

        if ($request->isXmlHttpRequest()) {
            return response()->json([
                'email' => ['These credentials do not match our records.'],
            ], 422);
        }
    }

    /**
     * Show registration form.
     *
     * @return array
     */
    public function showRegistrationForm()
    {
        return view('welcome');
    }

    /**
     * Register new user or client.
     *
     * @param RegisterEmailRequest $request request form input before validation
     *
     * @return array
     */
    protected function register(RegisterEmailRequest $request)
    {
        $user = $this->activation->save($request);

        if ($user->confirmed == 1) {
            return redirect()->back()->withErrors([
                'emails' => ['This account already exists for login. Please login!'],
            ]);
        }

        auth()->login($user);

        return redirect(strtolower($user->roles()->first()->name));
    }
}
