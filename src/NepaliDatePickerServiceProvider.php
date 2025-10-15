<?php

namespace Shreejan\FilamentNepaliDatePicker;

use Filament\Forms\Components\DatePicker;
use Illuminate\Support\ServiceProvider;

class NepaliDatePickerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-nepali-date-picker');
        
        // Debug: Check if views are loaded
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/filament-nepali-date-picker'),
            ], 'filament-nepali-date-picker-views');
        }

        // Publish assets manually (optional)
        $this->publishes([
            __DIR__.'/../resources/dist' => public_path('vendor/filament-nepali-date-picker'),
        ], 'filament-nepali-date-picker-assets');

        // Register macros
        DatePicker::macro('nepali', function (array $onlyLocales = [], bool $weekdaysMin = true) {
            return $this->view('filament-nepali-date-picker::components.nepali-date-picker')
                ->extraAttributes([
                    'onlyLocales' => is_array($onlyLocales) ? implode(',', $onlyLocales) : (string) $onlyLocales,
                    'weekdaysMin' => (int) $weekdaysMin,
                ], true);
        });

    }

    public function register(): void
    {
        //
    }
}