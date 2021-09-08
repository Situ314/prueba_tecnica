<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            'name' => 'GESTIÓN DE ROLES',
            'description' => 'Creación/Edición de roles',
        ]);

        DB::table('permissions')->insert([
            'name' => 'GESTIÓN DE ROLES DE USUARIOS',
            'description' => 'Creación/Edición de roles para los usuarios',
        ]);

        DB::table('permissions')->insert([
            'name' => 'GESTIÓN DE ENDPOINTS',
            'description' => 'Creación/Edición de Enpoinst',
        ]);

        DB::table('permissions')->insert([
            'name' => 'GESTIÓN DE ENDPOINTS SOBRE ROLES',
            'description' => 'Creación/Edición de Enpoinst sobre los roles',
        ]);

        DB::table('permissions')->insert([
            'name' => 'CHECK USUARIOS SIN ENDPOINTS',
            'description' => 'VERIFICACIÓN DE USUARIOS SIN ENDPOINTS',
        ]);

        DB::table('permissions')->insert([
            'name' => 'GESTIÓN DE PERFIL PROPIO',
            'description' => 'Verificación de perfil personal',
        ]);

        DB::table('permissions')->insert([
            'name' => 'VER ENDPOINTS PROPIOS',
            'description' => 'Verificación de endpoints propios',
        ]);
    }
}
