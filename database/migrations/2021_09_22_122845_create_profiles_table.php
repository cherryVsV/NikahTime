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
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->json('photos')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('country', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('contact_phone_number', 25)->nullable();
            $table->foreignId('education_id')->nullable()->constrained();
            $table->string('place_of_study', 255)->nullable();
            $table->string('place_of_work', 255)->nullable();
            $table->string('work_position', 255)->nullable();
            $table->foreignId('marital_status_id')->nullable()->constrained();
            $table->boolean('have_children')->nullable();
            $table->string('about')->nullable();
            $table->string('nationality')->nullable();
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
