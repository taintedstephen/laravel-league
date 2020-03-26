<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
            'name' => 'Stephen Vickers',
            'email' => 'stephen.vickers@hotmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
