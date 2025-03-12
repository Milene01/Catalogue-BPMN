<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepresentationFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('representation_forms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('description', 65535);
			$table->integer('classification_id')->index('fk_representations_form');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('representation_forms');
	}

}
