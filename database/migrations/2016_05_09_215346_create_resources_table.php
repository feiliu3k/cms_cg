<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name');
            $table->string('field_name');
            $table->string('operator')->default('=');
            $table->string('field_value');
            $table->timestamps();
        });

        Schema::create('resource_user', function (Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->integer('resource_id')->unsigned();

            $table->foreign('resource_id')
                  ->references('id')
                  ->on('resources')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->primary(['resource_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resource_user');
        Schema::drop('resources');
    }
}
