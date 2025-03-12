<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('filename');
			$table->string('title', 45);
			$table->text('description', 65535)->nullable();
			$table->integer('category_id')->index('fk_images_galery1_idx');
			$table->integer('publication_id')->index('fk_images_publications1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}
