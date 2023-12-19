<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        /* dd($request); */
        /* dd($request->get('email')); */

        //modificación al request
        $request->request->add(['username' => Str::slug($request->username)]);

        //validaciones
        $campos = [
            'name'     => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email'    => 'required|unique:users|email|min:3|max:30',
            /**expresiones regulares regex: de preferencia pasarla como un array*/
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
        ];

        $mensaje = [
            //alertas para validaciones
            "required" => 'El :attribute es requerido ', //:attribute es un comodin se sustituira por el nombre del atributo de la tabla al que el campo en el formulario hace referencia

            'password.regex' => 'La contraseña debe tener al menos ocho caracteres, una letra, un número y un carácter especial.'
        ];

        //unir validaciones y mensajes
        $this->validate($request, $campos, $mensaje);

        //dd('Creando usuario');

        /**equivalente a INSERT INTO usuarios */
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make( $request->password )
        ]);

        //autenticar usuario
        auth()->attempt([
            'email'    => $request->email,
            'password' => $request->password
        ]);

        //redireccionar
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
