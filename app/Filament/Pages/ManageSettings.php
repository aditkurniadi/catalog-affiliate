<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Pages\Page;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use Filament\Actions\Action; // Import untuk tombol save

class ManageSettings extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $title = 'Global Settings';

    // Properti ini JANGAN pakai static
    protected string $view = 'filament.pages.manage-settings';

    public $is_maintenance;

    public function mount()
    {
        // Ambil data dari database saat halaman dimuat
        $this->is_maintenance = Setting::where('key', 'is_maintenance')->first()?->value === '1';
    }

    // Fungsi untuk menyimpan perubahan
    public function save()
    {
        Setting::updateOrCreate(
            ['key' => 'is_maintenance'],
            ['value' => $this->is_maintenance ? '1' : '0']
        );

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();
    }

    // Menambahkan tombol save di header halaman
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->action('save')
                ->color('primary'),
        ];
    }
}
