<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Kline;
use Exception;

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
        $symbols = ["BTCUSDT", "ETHUSDT", "BNBUSDT", "ADAUSDT", "SOLUSDT", "XRPUSDT", "DOTUSDT", "DOGEUSDT", "LUNAUSDT", "UNIUSDT", "LTCUSDT", "AVAXUSDT", "LINKUSDT", "BCHUSDT", "ALGOUSDT", "SHIBUSDT"];

        foreach($symbols as $symbol) 
        {
            /**
             * Get data
             */
            $response = Http::get("https://api.binance.com/api/v3/klines?symbol=$symbol&interval=1d");

            $data = $response->json();

            /**
             * Handle error
             */
            if(isset($data["msg"]) && $data["msg"] === "Invalid symbol.") {
                $this->info("Invalid symbol $symbol");
                continue;
            }

            /**
             * Save to db
             */
            $count = count($data);

            $this->info("Pulled $count from /api/v3/klines for $symbol");

            foreach($data as $item) {
                Kline::updateOrCreate([
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
