<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NytBooksService
{
    protected string $baseUrl = 'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json';

    public function getBestSellerHistory(array $params, bool $useCache = true): array
    {
        $cacheKey = $this->generateCacheKey($params);

        if ($useCache && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = Http::retry(3, 100)
            ->timeout(5)
            ->get($this->baseUrl, array_merge($params, [
                'api-key' => config('services.nyt.api_key'),
            ]));

        if ($response->failed()) {
            // Optional: Log or throw exception
            return [
                'error' => 'Failed to fetch data from NYT',
                'status' => $response->status()
            ];
        }

        $data = $response->json();

        // Cache response for 1 hour
        if ($useCache) {
            Cache::put($cacheKey, $data, now()->addHour());
        }

        return $data;
    }

    protected function generateCacheKey(array $params): string
    {
        ksort($params); // Ensure consistent order
        return 'nyt_bestsellers_' . md5(json_encode($params));
    }
}
