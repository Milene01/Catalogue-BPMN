<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConflictsConstructsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conflicts_constructs', function(Blueprint $table)
		{
			$table->integer('conflict_id')->index('fk_conflict1');
			$table->integer('constructs_id')->index('fk_conflict_construct1');
			$table->primary(['conflict_id','constructs_id'], 'fk_55');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conflicts_constructs');
	}

}
