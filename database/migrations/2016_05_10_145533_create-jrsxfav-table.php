<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJrsxfavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jrsxfav', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('jrsxid')->unsigned();
            $table->integer('userid')->unsigned();

            $table->foreign('jrsxid')
                  ->references('id')
                  ->on('jrsx')
                  ->onDelete('cascade');

            $table->foreign('userid')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jrsxfav');
    }
}
