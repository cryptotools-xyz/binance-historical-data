<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klines', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->dateTime('open_time');
            $table->unsignedDecimal('open', 36, 18);
            $table->unsignedDecimal('high', 36, 18);
            $table->unsignedDecimal('low', 36, 18);
            $table->unsignedDecimal('close', 36, 18);
            $table->unsignedDecimal('volume', 36, 18);
            $table->dateTime('close_time');
            //$table->string('quote_aset_volume');
            //$table->string('number_of_trades');
            //$table->string('taker_buy_base_asset_volume');
            //$table->string('taker_buy_quote_asset_volume');
            //$table->string('ignore');
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
        Schema::dropIfExists('klines');
    }
}
