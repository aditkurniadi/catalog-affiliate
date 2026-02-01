<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;

class CatalogIndex extends Component
{
    // Variabel ini akan otomatis terhubung ke input search di view (Data Binding)
    public $search = '';
    public $selectedCategory = null;

    public function render()
    {

        $isMaintenance = \App\Models\Setting::where('key', 'is_maintenance')->first()?->value === '1';

        // Di dalam CatalogIndex.php
        if ($isMaintenance) {
            return view('livewire.maintenance'); // Sesuaikan foldernya
        }

        // Logic Query Database
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('catalog_number', 'like', '%' . $this->search . '%')
                    ->orWhere('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->latest()
            ->get();

        // Mengirim data produk dan kategori ke file tampilan (blade)
        return view('livewire.catalog-index', [
            'products' => $products,
            'categories' => Category::all()
        ]);
    }

    // Fungsi untuk memfilter kategori saat tombol diklik
    public function selectCategory($id)
    {
        $this->selectedCategory = $id;
    }

    // Fungsi untuk menghitung statistik klik sebelum diarahkan ke link asli
    public function trackClick($productId)
    {
        $product = Product::findOrFail($productId);
        $product->increment('click_count'); // Statistik bertambah di DB

        return redirect()->away($product->affiliate_link);
    }
}
