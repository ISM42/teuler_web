<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Usuarios;
use App\Models\Rol;
use App\Models\Area;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('contraseña'); // Nombre del input del HTML para contraseña
    
        // Buscar el usuario en la base de datos con su rol
        $usuario = Usuarios::with('rol')->where('email', $email)->first();
    
        // Verificar si el usuario existe y si la contraseña es correcta
        if ($usuario && Hash::check($password, $usuario->password)) {
            Auth::login($usuario);
    
            // Redirigir según el rol del usuario
            if ($usuario->rol && $usuario->rol->nombre === 'Estudiante') {
                return redirect('/cursos')->with('Confirmacion_login', "Registro exitoso, bienvenido " . $usuario->nombre);
            } elseif ($usuario->rol && $usuario->rol->nombre === 'Profesor') {
                return redirect('/home')->with('Confirmacion_login', "Registro exitoso, bienvenido " . $usuario->nombre);
            }
    
            // Si no tiene un rol específico, redirigir a una vista genérica
            return redirect('/home')->with('Confirmacion_login', "Registro exitoso, bienvenido " . $usuario->nombre);
        } else {
            return back()->with('Error_login', "Usuario o contraseña erróneos");
        }
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

//Método para registro de usuario
    public function create(Request $req)
    {
        /* if (Auth::check()) {
            return redirect('/home');
        } */
        
        if ($req->input('password') !== $req->input('password_2')) {
            return redirect()->back()->withErrors(['password' => 'Las contraseñas no coinciden. Intenta nuevamente.']);
        }

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

// Función para jalar los roles y áreas de los modelos.   
public function index(){
    $roles = Rol::all();
  //  dd($roles);
    
  $areas = Area::all();

    return view('index_teuler', compact('roles', 'areas'));
}



public function show()
{
    if (Auth::check()) {
        $usuarioId = Auth::id();
        $usuario = Usuarios::with('rol', 'area')->find($usuarioId);
        $roles = Rol::all();
        $areas = Area::all();

        return view('perfil_usuario', compact('usuario', 'roles', 'areas'));
    } else {
        return redirect('/');
    }
}



//método para actualizar información del usuario
public function update(Request $request)
{
    $usuario = Auth::user();

    $request->validate([
        'id_area' => 'required|integer',
        'nombre' => 'required|string|max:255',
        'apellido_p' => 'required|string|max:255',
        'apellido_m' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
       // 'id_rol' => 'required| integer',
    ]);

    $usuario->id_area = $request->id_area;
    $usuario->nombre = $request->nombre;
    $usuario->apellido_p = $request->apellido_p;
    $usuario->apellido_m = $request->apellido_m;
    $usuario->email = $request->email;
   // $usuario->id_rol = $request->id_rol;

   /*  if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('public/avatars', $avatarName);
        $usuario->avatar = 'avatars/' . $avatarName;
    } */

    $usuario->save();

    return redirect('/perfil')->with('success', 'Perfil actualizado correctamente.');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'password_actual' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $usuario = Auth::user();

    // Verificar si la contraseña actual es correcta
    if (!Hash::check($request->password_actual, $usuario->password)) {
        return redirect()->back()->withErrors(['password_actual' => 'La contraseña actual no es correcta.']);
    }

    // Actualizar la contraseña en la base de datos
    $usuario->password = Hash::make($request->new_password);
    $usuario->save();

    return redirect('/perfil')->with('success', 'Contraseña actualizada correctamente.');
}


// Método para actualizar el avatar
public function uploadAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $usuario = Auth::user();

    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('public/avatars', $avatarName);
        $usuario->avatar = 'avatars/' . $avatarName;
    }

    $usuario->save();

    return redirect()->back()->with('success', 'Avatar actualizado correctamente.');
}

// Método para eliminar el avatar
public function deleteAvatar()
{
    $usuario = Auth::user();

    // Restaurar a la imagen predeterminada (dejar el campo avatar vacío o poner una ruta predeterminada)
    $usuario->avatar = null;
    $usuario->save();

    return redirect()->back()->with('success', 'Avatar eliminado correctamente.');
}


public function destroy(Request $request)
    {
        if (Auth::check()) {
            $usuarioId = Auth::id();
            $usuario = Usuarios::find($usuarioId);
            $usuario->estatus = 0;
            $usuario->updated_at = Carbon::now()->toDateString();

            //Invalida sesión
            $request->session()->invalidate();
            $usuario->save();

            return redirect('/')->with('Confirmacion_eliminacion', 'La cuenta fue eliminada correctamente');
        } else {
            return redirect('/');
        }
    }

}
