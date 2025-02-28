<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("users:add", function () {
    $nom = $this->ask("Nom") ;
    $prenom = $this->ask("Prenom");
    $email = $this->ask("Email");
    $tel = $this->ask("Telephone");
    $password = $this->secret("password");

    User::create([
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "tel" => $tel,
        "role" => "user",
        "password" => bcrypt($password),
    ]);

    $this->Info("User added successfully");
});

Artisan::command("users:admin {id}", function () {
    $user = User::find($this->argument("id"));
    if (!$user) {
        $this->error("User ". $this->argument("id")." doesn't exist");
        return;
    }
    $user->role = "admin";
    $user->save();
    $this->Info("User ".$this->argument("id") ." is admin");
});