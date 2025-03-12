<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConflictsConstructsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conflicts_constructs', function(Blueprint $table)
		{
			$table->foreign('conflict_id', 'fk_conflict_construct1')->references('id')->on('conflicts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('constructs_id', 'fk_conflict_construct2')->references('id')->on('constructs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('conflicts_constructs', function(Blueprint $table)
		{
			$table->dropForeign('fk_conflict_has_constructs_conflict1');
			$table->dropForeign('fk_conflict_has_constructs_constructs1');
		});
	}

}
