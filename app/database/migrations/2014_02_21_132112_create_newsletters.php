<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletters extends Migration {

	public function up()
	{
		Schema::create('newsletters', function($table) {
	        $table->increments('id');
	        $table->integer('year');
	        $table->string('title');
	        $table->string('pdf');
	        $table->integer('active');
	        $table->date('post_date');
	        $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newsletters');
	}

}
