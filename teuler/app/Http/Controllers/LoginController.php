<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\Rol;
use App\Models\Area;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('contraseña'); //nombre del input del HTML para contraseña

        // Buscar el usuario en la base de datos
        $usuario = Usuarios::where('email', $email)->first();

      //      dd($usuario);

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($usuario && Hash::check($password, $usuario->password)) {
            Auth::login($usuario);
            return redirect('/home')->with('Confirmacion_login', "Registro exitoso, bienvenido " . $usuario->nombre_usuario);
        } else {
            return back()->with('Error_login', "Usuario o contraseña erróneos");
        }
    }

//Método para registro de usuario
    public function create(Request $req)
    {
        /* if (Auth::check()) {
            return redirect('/home');
        } */
        
 $usuario = new Usuarios(); //falta agregar el rol (cómo va a ser seleccionado)
    $usuario -> id_rol = $req ->input('rol'); 
    $usuario -> id_area = $req ->input('aa'); 
    $usuario -> nombre = $req ->input('name');
    $usuario -> apellido_p = $req ->input('ap'); 
    $usuario -> apellido_m = $req ->input('am');
    $usuario -> email = $req ->input('email');
    $usuario -> password = bcrypt($req ->input('password'));
//dd($usuario);
    $usuario->save();

        Auth::login($usuario);
        return redirect('/home')->with('Confirmacion_registro', "Registro exitoso, bienvenido " . $usuario->nombre);
    }

    
public function index(){
    $roles = Rol::all();
  //  dd($roles);
    

  $areas = Area::all();

    return view('index_teuler', compact('roles', 'areas'));
}

public function logout(Request $request)
{
    if (Auth::check()) {
        Auth::logout();
        //Invalida sesión
        $request->session()->invalidate();

        //Gerean un nuevo token para la proxima sesión
        $request->session()->regenerateToken();

        return redirect('/')->with('Confirmacion_logout', 'Haz cerrado sesión correctamente.');
    } else {
        return redirect('/');
    }
}

}
