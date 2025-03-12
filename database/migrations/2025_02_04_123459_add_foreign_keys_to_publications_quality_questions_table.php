<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPublicationsQualityQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publications_quality_questions', function(Blueprint $table)
		{
			$table->foreign('quality_question_id', 'fk_quality1')->references('id')->on('quality_questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('publication_id', 'fk_quality2')->references('id')->on('publications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('publications_quality_questions', function(Blueprint $table)
		{
			$table->dropForeign('fk_quality_question_has_publications_quality_question6');
			$table->dropForeign('fk_quality_question_has_publications_publications6');
		});
	}

}
