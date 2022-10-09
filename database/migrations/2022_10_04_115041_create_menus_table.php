<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('idMenu');
            $table->integer('idCategory')->nullable();
            $table->string('name', 150);
            $table->text('description');
            $table->unsignedDecimal('price', $precision = 5, $scale = 2);
            $table->integer('ratingcount')->nullable()->default(0);
            $table->integer('ratingsum')->nullable()->default(0);
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
        Schema::dropIfExists('menus');
    }
}
