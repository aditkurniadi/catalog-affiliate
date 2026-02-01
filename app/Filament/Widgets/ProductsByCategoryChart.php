<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProductsByCategoryChart extends ChartWidget
{
    protected static ?int $sort = 2; // Paling atas

    protected ?string $heading = 'Distribusi Produk per Kategori';

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Produk',
                    'data' => $categories->pluck('products_count')->toArray(),
                    'backgroundColor' => ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
