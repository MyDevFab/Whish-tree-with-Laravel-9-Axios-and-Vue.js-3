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
        Schema::create('resolutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('tree_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->boolean('checked')->nullable()->default(false);
            $table->boolean('onhold')->nullable()->default(false);
            $table->string('deadline')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('resolutions');
    }
};