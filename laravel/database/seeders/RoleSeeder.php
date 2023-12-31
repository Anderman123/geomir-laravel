<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// IMPORTACIONES MIAS -> DB
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar roles en la tabla 'roles'
        DB::table('roles')->insert([
            ['name' => 'author'],
            ['name' => 'editor'],
            ['name' => 'admin'],
        ]);
    }
}
