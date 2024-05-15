<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(User $user)
    {
        $users = User::leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
                      ->leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')
                      ->select('users.*', 'roles.name as role_name')
                      ->get();
        return view('pages/user_management', ['users' => $users]);
    }


    public function roles(Role $role)
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles]);
    }


//     public function create(Request $request)
//     {
//         $users = $request->input('users');
//         $createdUsersData = [];
//
//         foreach ($users as $userName) {
//             $user = User::create(['name' => $userName]);
//             $userId = $user->id;
//             $createdUsersData[] = ['id' => $userId, 'name' => $userName];
//         }
//
//         return response()->json(['users_data' => $createdUsersData, 'message' => "Users created successfully"]);
//     }

    public function update_input_element(Request $request, User $user)
        {
            $editedColumn = $request->input('column');
            $editedValue = $request->input('new_value');
            $editedRowId = $request->input('row_id');
            $updatedUser = User::find($editedRowId);

            if (!$updatedUser) {
                return response()->json(['message' => 'User not found'], 404);
            }

            if (!in_array($editedColumn, ['name', 'email'])) {
                return response()->json(['message' => 'Invalid column'], 400);
            }

            if ($editedColumn == 'name') {
                $updatedUser->name = $editedValue;
            } else {
                $updatedUser->email = $editedValue;
            }
            $updatedUser->save();

            return response()->json(['message' => 'User updated successfully'], 200);
        }

    public function update_select_element(Request $request)
        {
            $editedColumn = $request->input('column');
            $editedValue = $request->input('new_value');
            $editedRowId = $request->input('row_id');

            $affected = DB::table('user_roles')
                        ->where('user_id', $editedRowId)
                        ->update([$editedColumn => $editedValue,
                                'created_at' => now(),
                                'updated_at' => now()]);

            if ($affected === 0) {
                return response()->json(['message' => 'User role not found'], 404);
            }

            return response()->json(['message' => 'User updated successfully'], 200);
        }
}
