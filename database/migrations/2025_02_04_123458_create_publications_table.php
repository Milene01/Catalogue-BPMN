<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title');
			$table->integer('year')->nullable();
			$table->text('journal', 65535)->nullable();
			$table->string('url')->nullable();
			$table->text('authors', 65535)->nullable();
			$table->string('image')->nullable();
			$table->boolean('approved')->nullable();
			$table->integer('user_id')->nullable()->index('fk_publications_users_idx');
			$table->text('notes', 65535)->nullable();
			$table->timestamps();
			$table->integer('publications_id')->nullable()->index('fk_publications_publications1_idx');
			$table->enum('type', array('Book Chapter','Journal','Conference'))->nullable();
			$table->string('short_title', 100)->nullable();
		});
		Artisan::call('db:seed', [
			'--class' => PublicationSeeder::class
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publications');
	}

}
