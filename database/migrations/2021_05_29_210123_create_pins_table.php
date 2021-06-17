<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('foto');
            $table->string('url');
            $table->bigInteger('usuarioCreador')->unsigned();
            $table->bigInteger('tableroId')->unsigned();
            $table->foreign("tableroId",)
                ->references('id')
                ->on('tableros')
                ->onDelete('cascade');
            $table->foreign("usuarioCreador")
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('pins');
    }
}
