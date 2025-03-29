<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToConstructsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('constructs', function(Blueprint $table)
		{
			$table->foreign('publications_id', 'fk_constructs_publications1')->references('id')->on('publications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});

		Artisan::call('db:seed', [
			'--class' => 'ConstructSeeder'
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('constructs', function(Blueprint $table)
		{
			$table->dropForeign('fk_constructs_publications1');
		});
	}

}
