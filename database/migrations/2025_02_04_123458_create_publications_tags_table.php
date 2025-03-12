<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublicationsTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publications_tags', function(Blueprint $table)
		{
			$table->integer('publication_id')->index('fk_publication_tag');
			$table->integer('tag_id')->index('fk_publications_has_tags_tags1_idx');
			$table->primary(['publication_id','tag_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publications_tags');
	}

}
