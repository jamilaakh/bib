<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'nom' =>'required|max:255',
            'prenom' =>'required|max:255',
            'tel' =>'numeric',
            'email' =>'required|email|max:255|unique:users',
            'password' =>'required',
        ]);

        $user = User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'role' => 'user',
            'password' => bcrypt($data['password']),
        ]);
        Log::info("New User is created");
        return redirect('/')->with('message','Bienvenue dans notre site, Veuillez vous connecter en utilisant le bouton login');
    }

    public function update(Request $request, User $user) {
        $request->validate([
            "email" => 'required|email|unique:users,email,' . $user->id,
        ]);
        
        if (!empty($request->password)) {
            $user->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $user->update($request->only(['nom', 'prenom', "email"]));
        }

        return redirect()->route("profile");
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' =>'required|email',
            'password' =>'required',
        ]);
        $user = User::where('email', $data['email'])->first();
        if($user){
            $hasher = app('hash');
            if($hasher->check($data['password'], $user->password)){
                session()->put("user", $user);
                auth()->login($user);
                Log::info("User ID: $user->id has logged in");
                return redirect('/')->with('message', "Vous étes connecté avec succés");
            }
            return redirect('/login')->with('message','Vérifier votre mot de passe');
        }
        return redirect('/login')->with('message','Vérifier votre Email');
    } 

    public function logout (Request $request) {
        auth()->logout();
        Log::info("User has logged out");
        return redirect()->route("index");
    }
}