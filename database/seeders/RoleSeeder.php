<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Exemple de rôle admin
        DB::table('roles')->insert([
            'nomRole' => 'admin',
            'estArchive' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Exemple de rôle mentoré
        DB::table('roles')->insert([
            'nomRole' => 'mentore',
            'estArchive' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Exemple de rôle mentor
        DB::table('roles')->insert([
            'nomRole' => 'mentor',
            'estArchive' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
