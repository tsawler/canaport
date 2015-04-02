<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSplashItem extends Migration {

	public function up() {
    	Schema::create('splash_image', function($table) {
	        $table->increments('id');
	        $table->string('image');
	        $table->text('text');
	        $table->timestamps();
		});
	}

	public function down() {
    	Schema::drop('splash_image');
	}

}
