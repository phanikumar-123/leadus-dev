<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Providers\RouteServiceProvider;
use App\SubscpPlan;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public const OTP_TIME = 120;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'max:9999999999'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_photo' => ['image', 'nullable']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @param string $path
     * @return \App\User
     */
    protected function create(array $data, string $path)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'contact' => $data['phone'],
            'profile_photo' => $path,
            'user_role' => 2
        ]);
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();

        $path = '';

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $file->store('images/profiles');
        }

        event(new Registered($user = $this->create($request->all(), $path)));

        $this->guard()->login($user);

        $msg = array(
            'status' => true,
            'redirect' => RouteServiceProvider::HOME
        );

        return response()->json($msg);
    }

    public function sendOtp(Request $request) {
        $otp = rand(1000, 9999);
        $user = Auth::user();
        $userId = $user->id;
        $cache_name = 'otp_' . $userId;
        $data = array(
                    'otp'=> $otp
                );

        Cache::put($cache_name, $otp, now()->addSeconds(self::OTP_TIME));
        Mail::to($request->user())->send(new OtpMail($otp));

        $msg = array(
            'status' => true,
            'mail_id' => Auth::user()->email,
            'otp_time' => self::OTP_TIME
        );
        return response()->json($msg);
    }

    public function validateOtp(Request $request) {
        $userId = Auth::user()->id;
        $cache_name = 'otp_' . $userId;
        $otp = Cache::get($cache_name);
        $request->validate([
            'otp' => 'required|numeric'
        ]);
        $msg = [];
        if ($otp == $request->input('otp')) {
            Cache::forget($cache_name);
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
                $msg = array(
                    'status' => true
                );
                return response()->json($msg);
            }
        }

        $msg = array(
            'status' => false
        );

        return response()->json($msg);
    }

    public function renderPlansView() {
        return view('auth.plans', [
            'plans' => SubscpPlan::where('is_plan_active', true)->get()
        ]);
    }
}
