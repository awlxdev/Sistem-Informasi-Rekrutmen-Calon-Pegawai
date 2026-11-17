<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generate(Request $request): JsonResponse
    {
        $regions = [
            'SORONG',
            'KAIMANA',
            'FAKFAK',
            'MANOKWARI',
            'BIAK',
            'JAYAPURA',
            'MERAUKE',
            'TIMIKA',
            'NABIRE',
            'RAJA AMPAT',
            'MAKASSAR',
            'MANADO',
            'AMBON',
            'TERNATE',
            'DENPASAR',
            'BANDUNG',
            'SURABAYA',
            'YOGYAKARTA',
            'SEMARANG',
            'MEDAN',
        ];

        $answer = $regions[array_rand($regions)];

        $request->session()->put('captcha_answer', $answer);

        return response()->json([
            'question' => 'Ketik nama daerah berikut: '.$answer,
        ]);
    }
}
