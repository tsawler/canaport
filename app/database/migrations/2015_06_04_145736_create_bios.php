<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up() {
        Schema::create('bios', function($table) {
            $table->increments('id');
            $table->string('bio_name');
            $table->text('bio_text');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('bios');
    }

}
