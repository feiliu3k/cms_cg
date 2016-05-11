<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJrsxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jrsx', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('pic');
            $table->string('dh');
            $table->text('comments');
            $table->timestamp('postdate')->nullable()->index();
            $table->integer('delflag')->default(0)->index();
            $table->integer('f1')->default(1)->index();
            $table->string('ip');
            $table->string('localrecord');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jrsx');
    }
}
