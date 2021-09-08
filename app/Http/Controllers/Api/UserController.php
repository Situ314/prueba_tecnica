<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\User;
use App\V_NoPermissionUser;
use App\V_PermissionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // GEstion de usuario
    public function updateProfile(Request $request, $id)
    {
        try {
            $current_user = $request->user();

            $user = User::find($id);

            if ($current_user->id == $user->id) {
                $user->name = $request->name;
                $user->birth_date = $request->birth_date;

                $user->update();

                return response()->json([
                    'message' => 'Usuario modificado exitosamente'
                ], 200);
            }

            return response()->json([
                'message' => 'Usted no tiene los permisos necesarios para realizar esta acción'
            ], 401);


        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. '.$ex->getMessage(),
            ], $ex->getCode());
        }
    }

    public function createRole(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $current_user = $request->user();

            $permission = V_PermissionUser::where('username', $current_user->username)
                ->where('permission_name', 'GESTIÓN DE ROLES')
                ->get();

            if (count($permission) > 0) {
                $role = Role::create([
                    'name' => $request['name'],
                    'description' => $request['description'],
                ]);

                $role->update();

                return response()->json([
                    'message' => 'Rol creado exitosamente'
                ], 200);
            }

            return response()->json([
                'message' => 'Usted no tiene los permisos necesarios para realizar esta acción'
            ], 401);


        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. '.$ex->getMessage(),
            ]);
        }
    }

    public function setRoleUser(Request $request, $user_id)
    {
        try {
            $current_user = $request->user();

            $permission = V_PermissionUser::where('username', $current_user->username)
                ->where('permission_name', 'GESTIÓN DE ROLES DE USUARIOS')
                ->get();

            if (count($permission) > 0) {

                $user = User::findorfail($user_id);

                $user->roles()->sync($request->roles);

                return response()->json([
                    'message' => 'Usuario vinculado a roles exitosamente'
                ], 200);
            }

            return response()->json([
                'message' => 'Usted no tiene los permisos necesarios para realizar esta acción'
            ], 401);


        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. '.$ex->getMessage(),
            ], $ex->getCode());
        }
    }

    public function createPermission(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
            ]);
            $current_user = $request->user();

            $permission = V_PermissionUser::where('username', $current_user->username)
                ->where('permission_name', 'GESTIÓN DE ENDPOINTS')
                ->get();

            if (count($permission) > 0) {
                $permission = Permission::create([
                    'name' => $request['name'],
                    'description' => $request['description'],
                ]);

                $permission->update();

                return response()->json([
                    'message' => 'Permiso creado exitosamente'
                ], 200);
            }

            return response()->json([
                'message' => 'Usted no tiene los permisos necesarios para realizar esta acción'
            ], 401);

        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. '.$ex->getMessage(),
            ]);
        }
    }

    public function setRolePermission(Request $request, $role_id)
    {

        try {
//        dd($request->all());
            $current_user = $request->user();

            $permission = V_PermissionUser::where('username', $current_user->username)
                ->where('permission_name', 'GESTIÓN DE ENDPOINTS SOBRE ROLES')
                ->get();

            if (count($permission) > 0) {

                $role = Role::findorfail($role_id);

                $role->permissions()->sync($request->permissions);

                return response()->json([
                    'message' => 'Rol vinculado a permiso exitosamente'
                ], 200);
            }

            return response()->json([
                'message' => 'Usted no tiene los permisos necesarios para realizar esta acción'
            ], 401);

        } catch (\Exception $ex) {

            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. '.$ex->getMessage(),
            ], $ex->getCode());
        }

    }

    public function getPermissions(Request $request, $id)
    {
        try {
            $request->validate([
                'number_perpage' => 'required|int',
            ],[
                'number_perpage.required' => 'Debe escribir un número de datos para su paginación',
            ]);
            $current_user = $request->user();

            $user = User::find($id);

            $permission = V_PermissionUser::where('username', $current_user->username)
                ->where('permission_name', 'GESTIÓN DE ENDPOINTS')
                ->get();

            if (count($permission) > 0) {

                $permisos = V_PermissionUser::where('username', $user->username)->paginate($request->number_perpage);

                return response()->json([
                    'permisos' => $permisos
                ], 200);
//            }
            }

            return response()->json([
                'message' => 'Usted no tiene los permisos necesarios para realizar esta acción'
            ], 401);


        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. '.$ex->getMessage(),
            ]);
        }
    }

    public function getNoPermission(Request $request)
    {

        try {
            $request->validate([
                'number_perpage' => 'required|int',
            ],[
                'number_perpage.required' => 'Debe escribir un número de datos para su paginación',
            ]);
            $current_user = $request->user();

            $permission = V_PermissionUser::where('username', $current_user->username)
                ->where('permission_name', 'CHECK USUARIOS SIN ENDPOINTS')
                ->get();

            if (count($permission) > 0) {

                $permisos = V_NoPermissionUser::paginate($request->number_perpage);

                return response()->json([
                    'sin_permiso' => $permisos
                ], 200);
//            }
            }

            return response()->json([
                'message' => 'Usted no tiene los permisos necesarios para realizar esta acción'
            ], 401);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al procesar la solicitud. '.$ex->getMessage(),
            ]);
        }

    }
}
