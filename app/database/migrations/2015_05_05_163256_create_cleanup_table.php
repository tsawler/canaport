<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleanupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up() {
        Schema::create('cleanup_forms', function($table) {
            $table->increments('id');
            $table->string('cleanup_name');
            $table->string('title');
            $table->string('image');
            $table->text('above');
            $table->text('below');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('cleanup_forms');
    }

}
