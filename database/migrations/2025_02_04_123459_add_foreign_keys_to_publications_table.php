<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPublicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publications', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_publications_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('publications_id', 'fk_publications_publications1')->references('id')->on('publications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('publications', function(Blueprint $table)
		{
			$table->dropForeign('fk_publications_users');
			$table->dropForeign('fk_publications_publications1');
		});
	}

}
