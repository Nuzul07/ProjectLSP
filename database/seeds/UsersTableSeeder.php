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
            'name' => 'Nuzul',
            'email' => 'nzl@gmail.com',
            'alamat' =>'Jakarta',
            'password' => bcrypt('nzl123'),
            'level' => 'Admin Utama'
        ]);
    }
}
