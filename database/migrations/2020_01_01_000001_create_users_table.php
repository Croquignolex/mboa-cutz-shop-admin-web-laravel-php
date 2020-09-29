<?php

use App\Enums\Constants;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('password')->default(Hash::make(Constants::DEFAULT_PASSWORD));
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->default(Constants::DEFAULT_IMAGE);
            $table->string('avatar_extension')->default(Constants::DEFAULT_IMAGE_EXTENSION);
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('profession')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('creator_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}