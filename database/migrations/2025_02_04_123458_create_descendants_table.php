<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDescendantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('descendants', function(Blueprint $table)
		{
			$table->integer('descendant_id')->index('fk_publications_1');
			$table->integer('root_id')->index('fk_publications_2');
			$table->primary(['descendant_id','root_id'], 'fk_57');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('descendants');
	}

}
