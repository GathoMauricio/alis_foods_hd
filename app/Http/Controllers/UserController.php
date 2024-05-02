<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Categoria;
use App\Models\Sucursal;
use App\Models\DistritalSucursal;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name'); //->paginate(15);

        return view('usuarios.index', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function create()
    {
        $roles = Role::all();
        $categorias = Categoria::orderBy('nombre')->get();
        $sucursales = Sucursal::orderBy('nombre')->get();
        return view('usuarios.create', compact('roles', 'categorias', 'sucursales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roles' => 'required',
            'name' => 'required',
            'apaterno' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ], [
            'roles.required' => 'Este campo es obligatorio',
            'name.required' => 'Este campo es obligatorio',
            'apaterno.required' => 'Este campo es obligatorio',
            'telefono.required' => 'Este campo es obligatorio',
            'email.required' => 'Este campo es obligatorio',
            'email.email' => 'El formato de email es incorrecto',
            'email.unique' => 'Este email ya se encuentra registrado',
            'password.required' => 'Este campo es obligatorio',
            'password.confirmed' => 'La confirmación de contraseña no coincide',
            'password_confirmation.required' => 'Este campo es obligatorio',
        ]);

        $usuario = User::create([
            'categoria_id' => $request->categoria_id,
            'sucursal_id' => $request->sucursal_id,
            'name' => $request->name,
            'apaterno' => $request->apaterno,
            'amaterno' => $request->amaterno,
            'telefono' => $request->telefono,
            'telefono_emergencia' => $request->telefono_emergencia,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'foto' => "perfil.jpg",
            'distrital' => $request->distrital,
        ]);

        if ($request->distrital_sucursales) {
            foreach ($request->distrital_sucursales as $sucursal_id) {
                DistritalSucursal::create(['user_id' => $usuario->id, 'sucursal_id' => $sucursal_id]);
            }
        }

        $usuario->syncRoles($request->roles);

        if ($usuario) {
            return redirect()->route('usuarios')->with('message', 'El usuario ' . $usuario->email . ' se creó con éxito.');
        }
    }

    public function edit($id)
    {
        $roles = Role::all();
        $usuario = User::find($id);
        $categorias = Categoria::orderBy('nombre')->get();
        $sucursales = Sucursal::orderBy('nombre')->get();
        return view('usuarios.edit', compact('roles', 'usuario', 'categorias', 'sucursales'));
    }

    public function update(Request $request, $id)
    {
        $validations = [
            'roles' => 'required',
            'name' => 'required',
            'apaterno' => 'required',
            'telefono' => 'required',
        ];
        if ($request->password) {
            $validations = $validations + [
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required',
            ];
        }

        $request->validate($validations, [
            'roles.required' => 'Este campo es obligatorio',
            'name.required' => 'Este campo es obligatorio',
            'apaterno.required' => 'Este campo es obligatorio',
            'telefono.required' => 'Este campo es obligatorio',
            'password.required' => 'Este campo es obligatorio',
            'password.confirmed' => 'La confirmación de contraseña no coincide',
            'password_confirmation.required' => 'Este campo es obligatorio',
        ]);

        $usuario = User::find($id);

        $usuario->categoria_id = $request->categoria_id;
        $usuario->sucursal_id = $request->sucursal_id;
        $usuario->name = $request->name;
        $usuario->apaterno = $request->apaterno;
        $usuario->amaterno = $request->amaterno;
        $usuario->telefono = $request->telefono;
        $usuario->telefono_emergencia = $request->telefono_emergencia;
        $usuario->distrital = $request->distrital;

        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }

        if ($request->distrital == 'SI') {
            DistritalSucursal::where('user_id', $usuario->id)->delete();
            if ($request->distrital_sucursales) {
                foreach ($request->distrital_sucursales as $sucursal_id) {
                    DistritalSucursal::create(['user_id' => $usuario->id, 'sucursal_id' => $sucursal_id]);
                }
            }
        }

        $usuario->syncRoles($request->roles);

        if ($usuario->save()) {
            return redirect()->route('usuarios')->with('message', 'El usuario ' . $usuario->email . ' se actualizó con éxito.');
        }
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        $email = $usuario->email;
        if ($usuario->delete()) {
            return redirect()->route('usuarios')->with('message', 'El usuario ' . $email . ' se eliminó con éxito.');
        }
    }

    public function apiLogin(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {

            if (\Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    "estatus" => 1,
                    "mensaje" => "Inicio de sesión correcto.",
                    "auth_token" => $token,
                    "usuario" => $user,
                ]);
            } else {
                return response()->json([
                    "estatus" => 0,
                    "mensaje" => "Los datos de acceso no coinciden.",
                ]);
            }

            // if ($user->status == 'Activo') {
            //     if (\Hash::check($request->password, $user->password)) {
            //         $token = $user->createToken('auth_token')->plainTextToken;
            //         return response()->json([
            //             "estatus" => 1,
            //             "mensaje" => "Inicio de sesión correcto.",
            //             "auth_token" => $token,
            //             "usuario" => $user,
            //         ]);
            //     } else {
            //         return response()->json([
            //             "estatus" => 0,
            //             "mensaje" => "Su contraseña de acceso es incorrecta.",
            //         ]);
            //     }
            // } else {
            //     $user->tokens()->delete();
            //     return response()->json([
            //         "estatus" => 0,
            //         "mensaje" => "El usuario se encuentra inactivo por favor verifiquélo con su supervisor.",
            //     ]);
            // }
        } else {
            return response()->json([
                "estatus" => 0,
                "mensaje" => "El usuario no se encuentra registrado en el sistema.",
            ]);
        }
    }
}
