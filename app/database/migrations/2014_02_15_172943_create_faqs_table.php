<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration {

	public function up() {
    	Schema::create('faqs', function($table) {
	        $table->increments('id');
	        $table->string('label');
	        $table->string('question');
	        $table->string('answer');
	        $table->integer('active');
	        $table->timestamps();
		});
	}

	public function down() {
    	Schema::drop('faqs');
	}

}
