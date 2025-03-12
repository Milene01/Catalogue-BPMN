<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConstructsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('constructs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('concept');
			$table->string('form')->nullable();
			$table->text('description', 65535)->nullable();
			$table->enum('type', array('entity','relantioship'));
			$table->string('image');
			$table->integer('publications_id')->index('fk_constructs_publications1_idx');
			$table->string('example_image')->nullable()->unique('example_image_UNIQUE');
			$table->integer('priorization')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('constructs');
	}

}
