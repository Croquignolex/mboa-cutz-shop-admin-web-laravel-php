<?php

use App\Enums\Constants;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('image', 255)->default(Constants::DEFAULT_IMAGE);
            $table->string('image_extension', 50)->default(Constants::DEFAULT_IMAGE_EXTENSION);
            $table->string('name');
            $table->text('fr_description')->nullable();
            $table->text('en_description')->nullable();
            $table->unsignedInteger('creator_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}