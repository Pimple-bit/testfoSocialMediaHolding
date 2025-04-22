<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class DummyJsonService
{
protected string $baseUrl = 'https://dummyjson.com';

public function fetchProducts(string $query = 'iphone'): array
{
$response = Http::get("{$this->baseUrl}/products/search", [
'q' => $query,
]);

return $response->json('products') ?? [];
}
}
