<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceadvisorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('service_advisors', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('number',24);
            $table->string('extension', 24);
            $table->string('pushbullet_token', 128);
            $table->string('email',64);
            $table->rememberToken();
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
		Schema::drop('service_advisors');
	}

}
