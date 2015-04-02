<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFaqsTableChangeTwoCols extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('faqs', function($table) {
                $table->dropColumn('question');
                $table->dropColumn('answer');
        });
        Schema::table('faqs', function($table) {
                $table->text('question');
                $table->text('answer');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
