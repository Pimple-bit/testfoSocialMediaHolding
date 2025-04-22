<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Services\DummyJsonService;

class ImportProducts extends Command
{
    protected $signature = 'import:products {query=iphone}';
    protected $description = 'Импорт продуктов с DummyJSON API';

    public function __construct(protected DummyJsonService $api)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $query = $this->argument('query');
        $products = $this->api->fetchProducts($query);

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['title' => $data['title']],
                [
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'brand' => $data['brand'],
                    'category' => $data['category'],
                    'thumbnail' => $data['thumbnail'],
                ]
            );
        }

        $this->info("Импортировано продуктов: " . count($products));
        return Command::SUCCESS;
    }
}
