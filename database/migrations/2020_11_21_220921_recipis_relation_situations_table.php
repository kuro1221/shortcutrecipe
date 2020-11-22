<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecipisRelationSituationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('recipes_relation_situations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('recipe_id')->unsigned();
            $table->biginteger('situation_id')->unsigned();
            $table->foreign("recipe_id")->references('id')->on('recipes');
            $table->foreign("situation_id")->references('id')->on('situations');
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
        //
        Schema::dropIfExists('recipes_relation_situations');
    }
}
