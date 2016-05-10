<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaoCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chaocomment', function (Blueprint $table) {
            $table->increments('cid');
            $table->integer('tipid')->unsigned()->index();
            $table->string('comment',1000)->nullable();
            $table->string('localrecord',200)->nullable();
            $table->string('userip')->nullable();
            $table->timestamp('ctime')->nullable()->index();
            $table->integer('delflag')->default(0)->index();
            $table->integer('verifyflag')->default(0)->index();
            $table->timestamps();
            $table->foreign('tipid')->references('tipid')->on('chaosky')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chaocomment');
    }
}
