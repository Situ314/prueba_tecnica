<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'root',
            'password' => bcrypt('root123'),
            'name' => 'Adminsitrador',
            'birth_date' => '2021-10-10'
        ]);
    }
}
