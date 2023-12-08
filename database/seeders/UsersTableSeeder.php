<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crée deux utilisateurs spécifiques
        User::create([
            'nom' => 'John',
            'prenom' => 'Doe',
            'email_userName' => 'john@example.com',
            'datedeNaissance' => '1990-01-01',
            'telephone' => '123456789',
            'estArchive' => false,
            'domaine_id' => 1, // Remplacez par l'ID de domaine approprié
            'role_id' => 1, // Remplacez par l'ID de rôle approprié
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'nom' => 'Jane',
            'prenom' => 'Doe',
            'email_userName' => 'jane@example.com',
            'datedeNaissance' => '1995-02-15',
            'telephone' => '987654321',
            'estArchive' => false,
            'domaine_id' => 2, // Remplacez par l'ID de domaine approprié
            'role_id' => 2, // Remplacez par l'ID de rôle approprié
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

    }
}
