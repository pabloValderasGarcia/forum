<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title', 20);
            $table->string('message', 1460);
            $table->foreignId('idUser');
            $table->foreignId('idCategory');
            
            $table->timestamps();
            
            $table->foreign('idUser')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('idCategory')->references('id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
};
