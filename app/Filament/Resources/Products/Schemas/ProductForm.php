<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('catalog_number')
                    ->label('Nomor Katalog')
                    ->default(function () {
                        $lastProduct = \App\Models\Product::latest('id')->first();

                        if (!$lastProduct) {
                            return 'ETA-001';
                        }

                        // Ambil angka setelah 'ETA-'
                        $lastNumber = (int) str_replace('ETA-', '', $lastProduct->catalog_number);

                        // Gunakan STR_PAD_LEFT (Bukan PATH)
                        return 'ETA-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
                    })
                    ->readOnly()
                    ->required(),
                TextInput::make('title')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('affiliate_link')
                    ->required(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name') // 'category' adalah nama fungsi relasi di Model Product
                    ->searchable()
                    ->preload()
                    ->required(),
                // TextInput::make('click_count')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
            ]);
    }
}
