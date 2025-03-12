<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTextFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('text_fields', function(Blueprint $table)
		{
			$table->foreign('publication_id', 'fk_extratext_publications1')->references('id')->on('publications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('category_id', 'fk_extra_fields_categories1')->references('id')->on('categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('images_id', 'fk_text_fields_images1')->references('id')->on('images')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('text_fields', function(Blueprint $table)
		{
			$table->dropForeign('fk_extratext_publications1');
			$table->dropForeign('fk_extra_fields_categories1');
			$table->dropForeign('fk_text_fields_images1');
		});
	}

}
