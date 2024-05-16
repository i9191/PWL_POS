<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(){
        return LevelModel::all();
    }
    
    public function store(Request $request){
        $level = LevelModel::create($request->all());
        return response()->json($level,201);
    }

    public function show($id){
        $level = LevelModel::find($id);
        return response()->json($level,200);
    }

    public function update(Request $request, $id){
        $level = LevelModel::find($id);
        $level->update($request->all());
        return response()->json($level,200);
    }

    public function destroy($id){
        $level = LevelModel::find($id);
        $level->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Data Terhapus!',
        ]);
    }
}
