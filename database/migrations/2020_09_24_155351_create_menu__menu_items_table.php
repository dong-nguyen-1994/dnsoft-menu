<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu__menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('label')->nullable();
            $table->string('icon')->nullable();
            $table->string('class')->nullable();
            $table->string('target', 10)->nullable();
            $table->string('menu_builder_class')->nullable();
            $table->json('menu_builder_args')->nullable();
            $table->nestedSet();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menu__menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu__menu_items');
    }
}
