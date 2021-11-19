<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user1_id');
            $table->unsignedBigInteger('user2_id');
            $table->foreign('user1_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->foreign('user2_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->boolean('is_blocked')->default(false);
            $table->bigInteger('user_block')->nullable();
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
        Schema::dropIfExists('chats');
    }
}
