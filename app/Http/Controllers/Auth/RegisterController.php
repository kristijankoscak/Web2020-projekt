<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        $this->request = $request;
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $this->guard()->login($user);
        return $this->registered($request, $user) ? : redirect($this->redirectTo)->with('success','Uspješno ste registrirani!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $requirments = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'userPlace' => ['required', 'string', 'max:255'],
            'zupanija' => [''],
            'userAddress' => ['required', 'string', 'max:255'],
            'userContact' => ['required', 'string', 'max:255'],
            'userImage' => 'required|image|max:1999'
        ];
        if($this->request->userType === "prodavac"){
            $new_requirment = ['userOPG' => ['required', 'string', 'max:255']];
            $final_requirments = array_merge($requirments,$new_requirment);
            return Validator::make($data,$final_requirments);
        }
        else{
            return Validator::make($data,$requirments);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        if($this->request->hasFile('userImage')){
            $chosenFile = $this->request->file('userImage')->getClientOriginalName();
            $filename = pathinfo($chosenFile,PATHINFO_FILENAME);
            $extension = $this->request->file('userImage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $this->request->file('userImage')->storeAs('public/user_images',$fileNameToStore);
         }
        $user_data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_opg' => $data['userOPG'] ? $data['userOPG'] : "Unset" ,
            'image_link' => $fileNameToStore,
            'county' => $data['userCounty'],
            'city' => $data['userPlace'],
            'contact' => $data['userContact'],
            'address' => $data['userAddress']
        ];
        if($this->request->userType === "prodavac"){
            $final_data = array_merge($user_data,['user_type'=>'seller']);
            return User::create($final_data);
        }
        else{
            $final_data = array_merge($user_data,['user_type'=>'buyer']);
            return User::create($final_data);
        }
    }
}
