<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $user = UserModel::with('level')->get();
        return response()->json($user,200);
    }
    
    function show($id) {
        $user = UserModel::with('level')->find($id);
        if(!$user){
            return response()->json(['message' => 'Data user tidak ditemukan'], 404);
        }
        return response()->json($user,200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'username'=>'required|string|min:3|unique:m_user,username',
            'nama'=>'required|string|max:100',
            'password'=>'required|min:5',
            'level_id'=>'required|integer|exists:m_level,level_id',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
        ]);
        return response()->json($user,201);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'username'=>'required|string|min:3|unique:m_user,username,'.$id.',user_id',
            'nama'=>'required|string|max:100',
            'password'=>'nullable|min:5',
            'level_id'=>'required|integer|exists:m_level,level_id',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $user = UserModel::find($id);
        if(!$user){
            return response()->json(['message' => 'Data user tidak ditemukan'], 404);
        }
        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
        ]);
        return response()->json($user,200);
    }

    public function destroy($id){
        $check = UserModel::find($id);
        if(!$check){
            return response()->json(['message' => 'Data user tidak ditemukan'], 404);
        }
        try {
            UserModel::destroy($id);
            return response()->json(['message' => 'Data user berhasil dihapus'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000"){
                return response()->json([
                    'message' => 'Data user gagal dihapus',
                    'error' => 'Data user ini digunakan pada tabel lain'
                ], 500);
            }
            return response()->json([
                'message' => 'Data user gagal dihapus',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
