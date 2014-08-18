<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddToUniqueIndexToUrlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('urls', function(Blueprint $table)
		{
			$table->unique('to');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('urls', function(Blueprint $table)
		{
			$table->dropUnique('urls_to_unique');
		});
	}

}
