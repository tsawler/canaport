<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisconceptions extends Migration {

	public function up() {
    	Schema::create('misconceptions', function($table) {
	        $table->increments('id');
	        $table->string('label');
	        $table->text('question');
	        $table->text('answer');
	        $table->integer('active');
	        $table->timestamps();
		});
	}

	public function down() {
    	Schema::drop('misconceptions');
	}

}
