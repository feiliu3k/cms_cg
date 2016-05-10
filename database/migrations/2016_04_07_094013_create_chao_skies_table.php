<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaoSkiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chaosky', function (Blueprint $table) {
            $table->increments('tipid');
            $table->string('tiptitle',100);
            $table->string('tipimg1',200)->nullable();
            $table->mediumText('tipcontent');
            $table->timestamp('stime')->nullable()->index();
            $table->integer('postflag')->default(0);
            $table->timestamp('posttime')->nullable()->index();
            $table->integer('userid')->unsigned()->nullable()->index();
            $table->integer('post_user')->unsigned()->nullable()->index();
            $table->integer('readnum')->default(2100);
            $table->integer('proid')->unsigned()->index();
            $table->string('tipvideo',200)->nullable();
            $table->integer('commentflag')->default(0);
            $table->integer('delflag')->default(0)->index();
            $table->integer('draftflag')->default(0)->index();
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('post_user')->references('id')->on('users');
            $table->foreign('proid')->references('id')->on('chaopro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chaosky');
    }
}
