<?php

namespace Shreejan\FilamentNepaliDatePicker\Forms\Components;

use Filament\Forms\Components\DatePicker;

class NepaliDatePicker extends DatePicker
{
    protected string $view = 'filament-nepali-date-picker::components.nepali-date-picker';

    private bool|string $onlyLocales = true;
    private bool $weekdaysMin = true;

    public function onlyLocales(array $onlyLocales = []): static
    {
        $this->onlyLocales = is_array($onlyLocales) ? implode(',', $onlyLocales) : (is_bool($onlyLocales) ? (int) $onlyLocales : $onlyLocales);
        $this->extraAttributes(['onlyLocales' => $this->onlyLocales, 'weekdaysMin' => (int) $this->weekdaysMin], false);
        return $this;
    }

    public function weekdaysMin(bool $weekdaysMin = true): static
    {
        $this->weekdaysMin = $weekdaysMin;
        $this->extraAttributes(['weekdaysMin' => (int) $this->weekdaysMin, 'onlyLocales' => $this->onlyLocales], false);
        return $this;
    }

    public function dateFormat(string $format): static
    {
        $this->extraAttributes(['dateFormat' => $format], false);
        return $this;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->native(false);
        $this->extraAttributes([
            'weekdaysMin' => (int) $this->weekdaysMin,
            'onlyLocales' => (int) $this->onlyLocales,
        ], true);
        $this->suffixIcon('heroicon-o-calendar', isInline: true);
    }
}