<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->tinyInteger('role_id')->nullable();
			$table->string('email')->nullable();
            $table->string('first_name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->string('password', 100)->nullable();
            $table->string('username', 100)->nullable();
			$table->text('about_you')->nullable();
			$table->string('photo', 100)->nullable();
			$table->tinyInteger('gender')->default(1)->comment('1-male, 2-female');
			$table->date('dob')->nullable();
			$table->mediumText('street_1')->nullable();
			$table->mediumText('street_2')->nullable();
			$table->string('state', 150)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('zip', 20)->nullable();
			$table->integer('country_id')->nullable();
			$table->string('mobile', 30)->nullable();
			$table->string('phone', 50)->nullable();
			$table->string('website')->nullable();
			$table->tinyInteger('status')->default(0)->comment('0=inactive | 1=active | 2=Blocked');
            $table->rememberToken();
			$table->string('varify_hash', 50)->nullable();
            $table->dateTime('created_at')->nullable();
			$table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
