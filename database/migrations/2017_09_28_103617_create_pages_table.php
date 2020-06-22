<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
			$table->string('slug', 255)->nullable();
			$table->string('title', 255)->nullable();
			$table->text('content')->nullable();
			$table->string('meta_title', 255)->nullable();
			$table->string('meta_keywords', 255)->nullable();
			$table->mediumText('meta_description')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
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
        Schema::dropIfExists('pages');
    }
}
