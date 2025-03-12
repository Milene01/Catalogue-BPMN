<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images_tags', function(Blueprint $table)
		{
			$table->integer('images_id')->index('fk_images_has_tags_images1_idx');
			$table->integer('tags_id')->index('fk_images_has_tags_tags1_idx');
			$table->primary(['images_id','tags_id'],'fk_58');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images_tags');
	}

}
