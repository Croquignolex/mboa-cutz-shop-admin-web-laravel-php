<?php

use App\Enums\Constants;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('image', 255)->default(Constants::DEFAULT_IMAGE);
            $table->string('image_extension', 50)->default(Constants::DEFAULT_IMAGE_EXTENSION);
            $table->string('fr_name');
            $table->string('en_name');
            $table->text('fr_description')->nullable();
            $table->text('en_description')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedTinyInteger('rate')->default(0);
            $table->unsignedSmallInteger('discount')->default(0);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_most_sold')->default(false);
            $table->unsignedInteger('creator_id')->nullable();
            $table->unsignedInteger('category_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

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
        Schema::table('products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}