<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1; // Paling atas
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Total koleksi di katalog')
                ->descriptionIcon('heroicon-m-square-3-stack-3d')
                ->color('info'),

            Stat::make('Klik (7 Hari Terakhir)', Product::sum('click_count')) // Idealnya kamu punya table log_clicks, tapi kalau simple pakai field click_count:
                ->description('Total interaksi user')
                ->descriptionIcon('heroicon-m-cursor-arrow-rays')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // Ini dummy chart, bisa ditarik dari data asli
                ->color('success'),

            Stat::make('Kategori', Category::count())
                ->description('Total kategori produk')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'),
        ];
    }
}
