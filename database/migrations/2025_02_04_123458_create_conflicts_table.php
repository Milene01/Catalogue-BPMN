<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConflictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('conflicts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('description', 65535);
			$table->integer('conflict_category_id')->index('fk_conflict_category1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conflicts');
	}

}
