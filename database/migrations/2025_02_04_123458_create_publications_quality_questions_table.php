<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublicationsQualityQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publications_quality_questions', function(Blueprint $table)
		{
			$table->integer('quality_question_id')->index('fk_quality_question1');
			$table->integer('publication_id')->index('fk_quality_question2');
			$table->float('value', 10, 0);
			$table->primary(['quality_question_id','publication_id'],'fk_98');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publications_quality_questions');
	}

}
