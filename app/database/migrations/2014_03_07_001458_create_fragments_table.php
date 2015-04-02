<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFragmentsTable extends Migration {

	public function up()
	{
		Schema::create('fragments', function($table) {
	        $table->increments('id');
	        $table->integer('fragment_content');
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
		Schema::drop('fragments');
	}

}
