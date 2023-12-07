<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Exemple d'utilisateur avec le rôle admin
        DB::table('users')->insert([
            'role_id' => 1, // Assurez-vous que l'ID correspond à l'ID du rôle admin dans votre table des rôles
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'email_userName' => 'admin@example.com',
            'datedeNaissance' => '1990-01-01',
            'telephone' => '123456789',
            'estArchive' => false,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Assurez-vous de hasher le mot de passe
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Exemple d'utilisateur avec le rôle mentore
        DB::table('users')->insert([
            'role_id' => 2, // Assurez-vous que l'ID correspond à l'ID du rôle mentore dans votre table des rôles
            'nom' => 'Mentore',
            'prenom' => 'Mentore',
            'email_userName' => 'mentore@example.com',
            'datedeNaissance' => '1995-05-05',
            'telephone' => '987654321',
            'estArchive' => false,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Exemple d'utilisateur avec le rôle mentor
        DB::table('users')->insert([
            'role_id' => 3, // Assurez-vous que l'ID correspond à l'ID du rôle mentor dans votre table des rôles
            'nom' => 'Mentor',
            'prenom' => 'Mentor',
            'email_userName' => 'mentor@example.com',
            'datedeNaissance' => '1985-10-10',
            'telephone' => '555555555',
            'estArchive' => false,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
