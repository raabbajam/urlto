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
		$urls = DB::table('urls');
		$urls->create(['from' => 'abdTW', 'to' => 'http://twitter.com/SpeakAndCare']);
		$urls->create(['from' => 'abdFB', 'to' => 'http://www.facebook.com/jabbaar']);
	}
}
