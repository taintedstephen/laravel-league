<?php

use Illuminate\Database\Seeder;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('players')->insert([
			'psn' => 'AJL101LJA',
			'name' => 'Adam Lewis',
		]);

		DB::table('players')->insert([
			'psn' => 'andyjamie92',
			'name' => 'Andrew Jamieson',
		]);

		DB::table('players')->insert([
			'psn' => 'Arrrrrrgh_is_4',
			'name' => 'Stuart Allan',
		]);

		DB::table('players')->insert([
			'psn' => 'Beano-4th',
			'name' => 'Ben Forth',
		]);

		DB::table('players')->insert([
			'psn' => 'Chesstrophyman',
			'name' => 'John Gaymer',
		]);

		DB::table('players')->insert([
			'psn' => 'Divsutherland199',
			'name' => 'David Sutherland',
		]);

		DB::table('players')->insert([
			'psn' => 'Faz1000',
			'name' => 'Sue Norman',
		]);

		DB::table('players')->insert([
			'psn' => 'Gerand87',
			'name' => 'David Woodall',
		]);

		DB::table('players')->insert([
			'psn' => 'iiOrchard',
			'name' => 'Dan Orchard',
		]);

		DB::table('players')->insert([
			'psn' => 'KA_GUNNER',
			'name' => 'Gary Edwards',
		]);

		DB::table('players')->insert([
			'psn' => 'Karloosethemoose',
			'name' => 'Stephen Vickers',
		]);

		DB::table('players')->insert([
			'psn' => 'Kickapookate',
			'name' => 'Kate',
		]);

		DB::table('players')->insert([
			'psn' => 'KieranDun',
			'name' => 'Kieran Dunn',
		]);

		DB::table('players')->insert([
			'psn' => 'Kobjco',
			'name' => 'Kobjco',
		]);

		DB::table('players')->insert([
			'psn' => 'Lombaxtashie',
			'name' => 'Natasha Garside',
		]);

		DB::table('players')->insert([
			'psn' => 'Mattiec3107',
			'name' => 'Matt Clark',
		]);

		DB::table('players')->insert([
			'psn' => 'MBEdmondson',
			'name' => 'Matt Edmondson',
		]);

		DB::table('players')->insert([
			'psn' => 'Mike_Shaw_47',
			'name' => 'Mike Shaw',
		]);

		DB::table('players')->insert([
			'psn' => 'Milkybarkid1',
			'name' => 'Milky',
		]);

		DB::table('players')->insert([
			'psn' => 'Silent_death_8_5',
			'name' => 'Andy Worsnop',
		]);

		DB::table('players')->insert([
			'psn' => 'xlRhys-',
			'name' => 'Rhys Rees',
		]);

		DB::table('players')->insert([
			'psn' => 'xXLCTXx',
			'name' => 'Lee Telford',
		]);
    }
}
