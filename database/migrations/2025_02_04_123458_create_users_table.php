<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('social_id');
			$table->string('name');
			$table->string('provider', 45);
			$table->string('avatar');
			$table->string('email')->nullable()->unique('email_UNIQUE');
			$table->enum('rule', array('user','team','admin'))->default('user');
			$table->string('remember_token')->nullable();
			$table->timestamps();
			$table->string('affiliation')->nullable();
			$table->string('personal_url')->nullable();
		});

		Artisan::call('db:seed', [
			'--class' => 'UserSeeder'
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
