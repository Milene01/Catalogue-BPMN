<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 400);
			$table->text('description', 65535)->nullable();
			$table->enum('type', array('image','text','tag'));
			$table->integer('total_allowed')->default(0);
			$table->boolean('image_category')->default(0);
		});

		Artisan::call('db:seed', [
			'--class' => 'CategorySeeder'
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
