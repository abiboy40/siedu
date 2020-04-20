<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//mail
use DB;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Teacher::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'school_id' => $data['schoolid'],
            'user_id' => $user->id,
            'departement' => $data['departement']
        ]);

        return  $user;
    }

    //mail
    public function Register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if($validator->passes()){
            $user = $this->create($input)->toArray();
            $user['link'] = Str::random(30);

            DB::table('users_activations')->insert(['id_user' => $user['id'],'token' => $user['link']]);
            Mail::send('mail.activation',$user,function($message) use($user) {
                $message->to($user['email']);
                $message->subject('No-Reply - Activation Email');

            });
            return redirect()->to('login')->with('message' , "We send activation code, please check your email");
        }
        return back()->with('Error',$validator->error());
    }

    public function userActivation($token)
    {
        $check = DB::table('users_activations')->where('token', $token)->first();
        if (!is_null($check))
        {
            $user = User::find($check->id_user);
            if($user->is_active == 1)
            {
                return redirect()->to('login')->with('message', "User are already actived");
            }
            $user->update(['is_active' => 1]);
            DB::table('users_activations')->where('token', $token)->delete();
            return redirect()->to('login')->with('message', "User Actived");
        }
        return redirect()->to('login')->with('message',"Your token invalid");
    }
}
