<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('fr_name', 255);
            $table->string('en_name', 255);
            $table->text('fr_description')->nullable();
            $table->text('en_description')->nullable();
            $table->boolean('is_activated')->default(true);
            $table->unsignedInteger('creator_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('creator_id')
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}