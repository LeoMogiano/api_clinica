<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'foto' => ['nullable', 'image'],
            'role' => ['nullable'],
            'group' => ['nullable', 'string'],
            'especialidad' => ['nullable', 'string'],
            'sexo' => ['nullable'],
            'carnet' => ['nullable', 'string'],
            'telefono' => ['nullable', 'string'],
            'tipo_sangre' => ['nullable', 'string'],
            'contacto_emerg' => ['nullable', 'string'],
            'fecha_nac' => ['nullable', 'date'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $file = $data['foto'];
        $fileUrl = null;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'group' => $data['group'],
            'especialidad' => $data['especialidad'],
            'sexo' => $data['sexo'],
            'carnet' => $data['carnet'],
            'telefono' => $data['telefono'],
            'tipo_sangre' => $data['tipo_sangre'],
            'contacto_emerg' => $data['contacto_emerg'],
            'fecha_nac' => $data['fecha_nac'],
        ]);

        if ($file) {
            $fileName = time() . $file->getClientOriginalName();
            $directory = 'user_' . $user->id;

            Storage::disk('s3')->putFileAs($directory, $file, $fileName, 'public');
            $fileUrl = Storage::disk('s3')->url($directory . '/' . $fileName);

            $user->foto = $fileUrl;
            $user->save();
        }

        return $user;
    }
}
