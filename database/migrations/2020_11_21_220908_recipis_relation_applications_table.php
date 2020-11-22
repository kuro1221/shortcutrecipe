<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecipisRelationApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('recipes_relation_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('application_id')->unsigned();
            $table->biginteger('recipe_id')->unsigned();
            $table->foreign("recipe_id")->references('id')->on('recipes');
            $table->foreign("application_id")->references('id')->on('applications');
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
        Schema::dropIfExists('recipes_relation_applications');
    }
}
