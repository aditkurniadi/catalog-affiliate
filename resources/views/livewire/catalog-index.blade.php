<div x-data="{ showTop: false }" @scroll.window="showTop = (window.pageYOffset > 150) ? true : false"
    class="min-h-screen bg-[#FDFDFD] text-[#1A1A1A] font-['Poppins'] pb-20">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <header class="pt-12 pb-6 px-6 max-w-xl mx-auto text-center">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 uppercase">Catalog Product</h1>
        <div class="h-1.5 w-8 bg-blue-600 mx-auto mt-2 rounded-full"></div>
    </header>

    <div class="max-w-xl mx-auto px-5">
        <div class="mb-6">
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari nomor katalog atau nama produk..."
                class="w-full bg-[#F5F5F5] border border-gray-100 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500/20 focus:bg-white outline-none transition-all placeholder:text-gray-400 text-sm shadow-sm text-gray-900">
        </div>

        <div class="flex gap-2 overflow-x-auto pb-4 mb-6 no-scrollbar">
            <button wire:click="$set('selectedCategory', null)"
                class="whitespace-nowrap px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wide transition-all {{ !$selectedCategory ? 'bg-gray-900 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-500 hover:bg-gray-100' }}">
                Semua
            </button>
            @foreach ($categories as $cat)
                <button wire:click="$set('selectedCategory', {{ $cat->id }})"
                    class="whitespace-nowrap px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wide transition-all {{ $selectedCategory == $cat->id ? 'bg-gray-900 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-500 hover:bg-gray-100' }}">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <div class="space-y-3">
            @forelse ($products as $product)
                <button wire:click="trackClick({{ $product->id }})"
                    class="w-full flex items-center justify-between p-5 bg-white border border-gray-200 rounded-2xl hover:border-blue-500 hover:shadow-xl hover:shadow-blue-500/5 transition-all active:scale-[0.97] group">

                    <div class="flex flex-col text-left">
                        <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1.5">
                            Ref: {{ $product->catalog_number }}
                        </span>
                        <h3
                            class="text-[15px] font-bold text-gray-900 leading-snug group-hover:text-blue-700 transition-colors">
                            {{ $product->title }}
                        </h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter italic">
                                {{ $product->category->name ?? 'Umum' }}
                            </span>
                            <span class="text-gray-200 text-[10px]">•</span>
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter">
                                {{ $product->click_count }} Klik
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center text-gray-300 group-hover:text-blue-600 transition-colors ml-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>
                </button>
            @empty
                <div class="py-20 text-center border-2 border-dashed border-gray-200 rounded-3xl">
                    <p class="text-gray-400 text-sm font-semibold uppercase tracking-widest">Produk tidak ditemukan</p>
                </div>
            @endforelse
        </div>

        <footer class="mt-24 mb-2 text-center border-t border-gray-100 pt-8">
            <p class="text-[10px] font-bold text-gray-400 tracking-[0.3em] uppercase">
                Archive by Adit Kurniadi
            </p>
        </footer>
    </div>

    <button x-show="showTop" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-10" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-6 p-4 bg-gray-900 shadow-2xl rounded-2xl text-white z-50 transition-all active:scale-90 border border-gray-800">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path>
        </svg>
    </button>
</div>
