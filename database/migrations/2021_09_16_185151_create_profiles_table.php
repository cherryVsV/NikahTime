<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('avatar', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('gender', 20)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('country', 255)->nullable();
            $table->string('town', 255)->nullable();
            $table->foreignId('education_id')->nullable()->constrained();
            $table->string('place_of_study', 255)->nullable();
            $table->string('place_of_work', 255)->nullable();
            $table->string('post', 255)->nullable();
            $table->foreignId('marital_status_id')->nullable()->constrained();
            $table->boolean('children')->nullable();
            $table->foreignId('habit_id')->nullable()->constrained();
            $table->text('about_me')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
