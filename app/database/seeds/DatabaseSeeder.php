<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UrlTableSeeder');
	}

}

/**
 *
 */
class UrlTableSeeder extends Seeder
{

	function run()
	{
		DB::table('urls')->delete();
		Url::create(['from' => 'abdTW', 'to' => 'http://twitter.com/SpeakAndCare']);
		Url::create(['from' => 'abdFB', 'to' => 'http://www.facebook.com/jabbaar']);
	}
}
