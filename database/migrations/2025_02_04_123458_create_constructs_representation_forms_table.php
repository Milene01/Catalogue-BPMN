<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConstructsRepresentationFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('constructs_representation_forms', function(Blueprint $table)
		{
			$table->integer('constructs_id')->index('fk_constructs_representation_1');
			$table->integer('representation_forms_id')->index('fk_constructs_representation_form_1');
			$table->primary(['constructs_id','representation_forms_id'],'fk_56');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('constructs_representation_forms');
	}

}
