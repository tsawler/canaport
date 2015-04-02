<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvolvements extends Migration {

	public function up()
	{
		Schema::create('involvements', function($table) {
	        $table->increments('id');
	        $table->integer('active');
	        $table->text('content');
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
		Schema::drop('involvements');
	}

}
