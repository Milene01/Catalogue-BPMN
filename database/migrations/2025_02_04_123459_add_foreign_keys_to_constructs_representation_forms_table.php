<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConstructsRepresentationFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('constructs_representation_forms', function(Blueprint $table)
		{
			$table->foreign('constructs_id', 'fk_crrrrr')->references('id')->on('constructs')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('representation_forms_id', 'fk_crfrf')->references('id')->on('representation_forms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('constructs_representation_forms', function(Blueprint $table)
		{
			$table->dropForeign('fk_constructs_has_representation_forms_constructs1');
			$table->dropForeign('fk_constructs_has_representation_forms_representation_forms1');
		});
	}

}
