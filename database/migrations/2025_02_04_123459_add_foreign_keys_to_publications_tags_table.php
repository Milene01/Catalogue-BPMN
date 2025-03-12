<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPublicationsTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publications_tags', function(Blueprint $table)
		{
			$table->foreign('publication_id', 'fk_pugtag1')->references('id')->on('publications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tag_id', 'fk_pugtag2')->references('id')->on('tags')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('publications_tags', function(Blueprint $table)
		{
			$table->dropForeign('fk_publications_has_tags_publications1');
			$table->dropForeign('fk_publications_has_tags_tags1');
		});
	}

}
