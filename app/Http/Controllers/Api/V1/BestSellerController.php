<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NytBooksService;


class BestSellerController extends Controller
{
    public function index(Request $request, NytBooksService $nytBooksService)
    {
        $queryParams = $request->validate([]);
        $cacheBypass = $request->boolean('cache', true); // defaults to true
        $data = $nytBooksService->getBestSellerHistory($queryParams, $cacheBypass);

        return response()->json([
            'timestamp' => now(),
            'cache_status' => $cacheBypass ? 'live' : 'bypassed',
            'data' => $data
        ]);
    }
}
