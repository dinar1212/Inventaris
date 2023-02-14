<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $response = [
            "success" => true,
            "data" => $user,
            "message" => "data user",
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],
            [
                'name.required' => 'Masukkan name user !',
                'email.required' => 'Masukkan email user !',
                'password.required' => 'Masukkan password user !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data' => $validator->errors(),
            ], 401);

        } else {

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('email')),
            ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'user Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'user Gagal Disimpan!',
                ], 401);
            }
        }
    }

    public function show($id)
    {
        $user = User::whereId($id)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Detail user!',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user Tidak Ditemukan!',
                'data' => '',
            ], 401);
        }
    }

    public function update(Request $request,$id)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],
            [
                'name.required' => 'Masukkan name user !',
                'email.required' => 'Masukkan email user !',
                'password.required' => 'Masukkan password user !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data' => $validator->errors(),
            ], 401);

        } else {

            $user = User::findOrFail($id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'user Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'user Gagal Diupdate!',
                ], 401);
            }
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'user Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user Gagal Dihapus!',
            ], 400);
        }
    }

}