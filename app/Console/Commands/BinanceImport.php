<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Kline;

class BinanceImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'binance:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import klines to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $symbols = ["BTCUSDT", "ETHUSDT", "BNBUSDT", "ADAUSDT", "SOLUSDT", "DOTUSDT"];

        foreach($symbols as $symbol) 
        {
            $response = Http::get("https://api.binance.com/api/v3/klines?symbol=$symbol&interval=1d");

            $data = $response->json();

            $count = count($data);

            $this->info("Pulled $count from /api/v3/klines for $symbol");

            foreach($data as $item) {
                Kline::create([
                    'symbol' => $symbol,
                    'open_time' =>  date("Y-m-d H:i:s", $item[0] / 1000), //source: https://stackoverflow.com/questions/39569312/epoch-unix-timestamp-conversion-in-php-and-mysql-is-not-working-properly
                    'open' => $item[1],
                    'high' => $item[2],
                    'low' => $item[3],
                    'close' => $item[4],
                    'volume' => $item[5],
                    'close_time' => date("Y-m-d H:i:s", $item[6] / 1000)
                ]);
            }

            $this->info("done...");
        }

        return Command::SUCCESS;
    }
}
