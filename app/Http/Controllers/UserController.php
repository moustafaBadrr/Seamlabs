<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $req){
        User::insert([
            'user_name' => $req->user_name,
            'email' => $req->email,
            'date_of_birth' => Carbon::create($req->date_of_birth),
            'phone_number' => $req->phone_number,
            'password' => Hash::make($req->password),
            'created_at' => Carbon::now()
        ]);

        return response()->json(['Message' => "The User Created Successfully"], 201);
    }

    public function login(Request $req){
        // How to know if the user has already logged in! to avoid create another hash!!!!!!!
        $user = User::where('user_name', $req->user_name)->first();

        if (!$user) {
            return response()->json(['Message' => 'User Not found'], 404);
        } else {
            if ($user->user_name == $req->user_name  && Hash::check($req->password, $user->password)){
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'Message' => 'User Logged in',
                    'token' => $token
                ], 200);
            } else {
                return response()->json(['message' => "User Name or Password is Invalid"], 404);
            }
        }
    }

    public function read(Request $req){
        $user = User::where("id", $req->id)->first();

        if(!$user) {
            return response()->json(["Message" => "User Not Found"], 404);
        }

        return User::where("id", $req->id)->first();
    }

    public function read_all(){
        $users = User::all();

        if(!$users) {
            return response()->json(["Message" => "There are no users"], 404);
        }

        return response()->json($users);
    }

    public function update(Request $req){
        $user = $req->user();

        if(!$user){
            return response()->json(["Message", "This User Does not Exists"]);
        }

       $user->update([
            'user_name' => $req->user_name,
            'email' => $req->email,
            'date_of_birth' => Carbon::create($req->date_of_birth),
            'phone_number' => $req->phone_number,
            'password' => Hash::make($req->password),
            'updated_at' => Carbon::now()
        ]);

        return response()->json(["Message", "User Updated Successfully"]);
    }

    public function delete(Request $req){
        $user = User::where("id", $req->id)->get("id")->first();

        if(!$user){
            return response()->json(["Message", "This User Does not Exists"]);
        }

        User::where("id", $req->id)->delete();

        return response()->json(["Message", "User Deleted Successfully"]);
    }

    public function logout(Request $req){
        $user = $req->user();

        if(!$user){
            return response()->json(["Message", "This User does not log in"]);
        }

        $user->currentAccessToken()->delete();

        return response()->json(["Message", "Logged Out"]);
    }
}
