<?php

use Illuminate\Database\Seeder;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('divisions')->insert([
            'name' => 'Division 1',
        ]);

		DB::table('divisions')->insert([
            'name' => 'Division 2',
        ]);

		DB::table('divisions')->insert([
            'name' => 'Division 3',
        ]);
		DB::table('divisions')->insert([
            'name' => 'Division 4',
        ]);
    }
}
