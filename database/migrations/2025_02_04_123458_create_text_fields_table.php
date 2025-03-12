<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('text_fields', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('content', 65535)->nullable();
			$table->integer('publication_id')->index('fk_extratext_publications1_idx');
			$table->integer('category_id')->index('fk_extra_fields_categories1_idx');
			$table->integer('images_id')->nullable()->index('fk_text_fields_images1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('text_fields');
	}

}
