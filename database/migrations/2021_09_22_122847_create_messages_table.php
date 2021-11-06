<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receiver_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->foreign('receiver_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->foreign('chat_id')
                ->references('id')
                ->on('chats')
                ->onDelete('CASCADE');
            $table->text('message');
            $table->boolean('is_seen')->default('false');
            $table->string('type')->default('text');
            $table->softDeletes();
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
        Schema::dropIfExists('messages');
    }
}
