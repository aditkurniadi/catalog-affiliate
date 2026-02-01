<x-filament-panels::page>
    <div class="max-w-md">
        <x-filament::section shadow="sm">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">Maintenance Mode</h3>
                        <p class="text-[11px] text-gray-500 mt-0.5">Nonaktifkan katalog untuk pengunjung umum.</p>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="is_maintenance" class="sr-only peer">
                        <div
                            class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>

                <hr class="border-gray-50">

                <div class="flex justify-end">
                    <x-filament::button wire:click="save" color="primary" size="sm"
                        class="rounded-lg px-6 font-bold uppercase tracking-wider text-[10px]">
                        Update Status
                    </x-filament::button>
                </div>
            </div>
        </x-filament::section>

        <div class="mt-4 px-1">
            @if ($is_maintenance)
                <div class="flex items-center gap-2 text-[10px] font-bold text-amber-600 uppercase tracking-[0.2em]">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    Katalog Sedang Maintenance
                </div>
            @else
                <div class="flex items-center gap-2 text-[10px] font-bold text-emerald-600 uppercase tracking-[0.2em]">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Katalog Sedang Online
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
