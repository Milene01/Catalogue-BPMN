<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDescendantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('descendants', function(Blueprint $table)
		{
			$table->foreign('descendant_id', 'fk_pub_pub1')->references('id')->on('publications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('root_id', 'fk_pub_pub2')->references('id')->on('publications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('descendants', function(Blueprint $table)
		{
			$table->dropForeign('fk_publications_has_publications_publications1');
			$table->dropForeign('fk_publications_has_publications_publications2');
		});
	}

}
