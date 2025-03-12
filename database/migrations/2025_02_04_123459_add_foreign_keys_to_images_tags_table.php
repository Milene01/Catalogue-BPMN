<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImagesTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('images_tags', function(Blueprint $table)
		{
			$table->foreign('images_id', 'fk_images_has_tags_images1')->references('id')->on('images')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tags_id', 'fk_images_has_tags_tags1')->references('id')->on('tags')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('images_tags', function(Blueprint $table)
		{
			$table->dropForeign('fk_images_has_tags_images1');
			$table->dropForeign('fk_images_has_tags_tags1');
		});
	}

}
