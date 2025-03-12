<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConflictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conflicts', function(Blueprint $table)
		{
			$table->foreign('conflict_category_id', 'fk_conflicts_conflict_category1')->references('id')->on('conflict_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('conflicts', function(Blueprint $table)
		{
			$table->dropForeign('fk_conflicts_conflict_category1');
		});
	}

}
