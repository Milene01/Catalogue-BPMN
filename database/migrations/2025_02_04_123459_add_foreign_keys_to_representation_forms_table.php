<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRepresentationFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('representation_forms', function(Blueprint $table)
		{
			$table->foreign('classification_id', 'fk_rep_fin')->references('id')->on('classifications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('representation_forms', function(Blueprint $table)
		{
			$table->dropForeign('fk_representation_forms_finalities1');
		});
	}

}
