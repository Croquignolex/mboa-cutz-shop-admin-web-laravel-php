<?php

use App\Models\User;
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
            $table->string('email', Constants::DEFAULT_STRING_LENGTH)->unique();
            $table->string('password',Constants::DEFAULT_STRING_LENGTH)->default(Hash::make(Constants::DEFAULT_PASSWORD));
            $table->string('first_name', Constants::DEFAULT_STRING_LENGTH);
            $table->string('last_name', Constants::DEFAULT_STRING_LENGTH);
            $table->string('avatar', Constants::DEFAULT_STRING_LENGTH)->default(Constants::DEFAULT_IMAGE);
            $table->string('avatar_extension', Constants::DEFAULT_STRING_LENGTH)->default(Constants::DEFAULT_IMAGE_EXTENSION);
            $table->string('address', Constants::DEFAULT_STRING_LENGTH)->nullable();
            $table->string('post_code', Constants::DEFAULT_STRING_LENGTH)->nullable();
            $table->string('city', Constants::DEFAULT_STRING_LENGTH)->nullable();
            $table->string('country', Constants::DEFAULT_STRING_LENGTH)->nullable();
            $table->string('phone', Constants::DEFAULT_STRING_LENGTH)->nullable();
            $table->string('profession', Constants::DEFAULT_STRING_LENGTH)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->unsignedInteger('role_id');
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::dropIfExists('users');
    }
}