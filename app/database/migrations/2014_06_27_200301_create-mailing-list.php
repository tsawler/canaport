<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingList extends Migration {

	public function up() {
    	Schema::create('mailing_lists', function($table) {
	        $table->increments('id');
	        $table->string('first_name');
	        $table->string('last_name');
	        $table->string('email');
	        $table->timestamps();
		});
	}

	public function down() {
    	Schema::drop('mailing_lists');
	}

}
