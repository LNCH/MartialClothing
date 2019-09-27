<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity')->unsigned()->index();
            $table->unsignedBigInteger('product_variation_id')->index();
            $table->timestamps();

            $table->foreign('product_variation_id')->references('id')
                ->on('product_variations')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_blocks');
    }
}
