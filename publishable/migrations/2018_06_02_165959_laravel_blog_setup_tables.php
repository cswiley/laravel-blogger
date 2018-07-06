<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaravelBlogSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->integer('visibility')->default(0);
            $table->longText('content')->nullable();
            $table->datetime('published_at')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });


        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogs');
    }
}
