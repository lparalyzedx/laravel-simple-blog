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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->longText('content');
            $table->integer('order');
            $table->integer('status')->default(1)->comment('1 aktif, 0 pasif');
            $table->softDeletes();
            $table->timestamp('create_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->OnUpdateCurrent();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
