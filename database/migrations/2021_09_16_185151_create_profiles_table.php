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
            $table->foreignId('user_id')->constrained();
            $table->string('avatar', 255);
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('gender', 20);
            $table->date('birthdate');
            $table->string('country', 255);
            $table->string('town', 255);
            $table->foreignId('education_id')->constrained();
            $table->string('place_of_study', 255);
            $table->string('place_of_work', 255);
            $table->string('post', 255);
            $table->foreignId('marital_status_id')->constrained();
            $table->boolean('children');
            $table->foreignId('habit_id')->constrained();
            $table->text('about_me');
            $table->timestamps();
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
