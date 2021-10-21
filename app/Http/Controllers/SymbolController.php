<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kline;

class SymbolController extends Controller
{
    public function show($symbol, $period = 1)
    {
        $number = $period;

        $data = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->take($number)->get();

        $avgOpen = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->avg('open');
        $avgHigh = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->avg('high');
        $avgLow = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->avg('low');
        $avgClose = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->avg('close');

        $medianOpen = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->median('open');
        $medianHigh = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->median('high');
        $medianLow = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->median('low');
        $medianClose = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->median('close');

        $maxHigh = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->max('high');
        $minLow = Kline::where('symbol', $symbol)->orderBy('open_time', 'desc')->limit($number)->get()->min('low');

        return view('symbols.show', [
            'data' => $data,
            'period' => $period,
            'symbol' => $symbol,

            'avgOpen' => $avgOpen < 1 ? number_format($avgOpen, 18) : $avgOpen,
            'avgHigh' => $avgHigh < 1 ? number_format($avgHigh, 18) : $avgHigh,
            'avgLow' => $avgLow < 1 ? number_format($avgLow, 18) : $avgLow,
            'avgClose' => $avgClose < 1 ? number_format($avgClose, 18) : $avgClose,

            'medianOpen' => $avgOpen < 1 ? number_format($medianOpen, 18) : $avgOpen,
            'medianHigh' => $avgHigh < 1 ? number_format($medianHigh, 18) : $avgHigh,
            'medianLow' => $avgLow < 1 ? number_format($medianLow, 18) : $avgLow,
            'medianClose' => $avgClose < 1 ? number_format($medianClose, 18) : $avgClose,

            'maxHigh' => $maxHigh,
            'minLow' => $minLow
        ]);
    }
}
