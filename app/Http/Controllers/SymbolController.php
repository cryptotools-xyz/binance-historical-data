<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kline;

class SymbolController extends Controller
{
    public function show($id)
    {
        $number = 15;

        $data = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->take($number)->get();

        $avgOpen = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->avg('open');
        $avgHigh = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->avg('high');
        $avgLow = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->avg('low');
        $avgClose = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->avg('close');

        $medianOpen = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->median('open');
        $medianHigh = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->median('high');
        $medianLow = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->median('low');
        $medianClose = Kline::where('symbol', $id)->orderBy('open_time', 'desc')->limit($number)->get()->median('close');

        return view('symbols.show', [
            'data' => $data,

            'avgOpen' => $avgOpen,
            'avgHigh' => $avgHigh,
            'avgLow' => $avgLow,
            'avgClose' => $avgClose,

            'medianOpen' => $medianOpen,
            'medianHigh' => $medianHigh,
            'medianLow' => $medianLow,
            'medianClose' => $medianClose
        ]);
    }
}
