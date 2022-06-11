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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(500)->comment('Сортировка');

            $table->foreignId('menu_id')
                ->comment('Меню, в котором состоит элемент')
                ->nullable()
                ->constrained('menus');

            $table->foreignId('link_menu_id')
                ->comment('Подменю, на которое ссылается элемент')
                ->nullable()
                ->constrained('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
};
