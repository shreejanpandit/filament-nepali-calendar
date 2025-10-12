<?php

namespace Shreejan\FilamentNepaliDatePicker\Forms\Components;

use Filament\Forms\Components\DateTimePicker;

class NepaliDateTimePicker extends DateTimePicker
{
    protected array $onlyLocales = ['ne', 'np'];
    protected bool $weekdaysMin = true;
    protected int $hourMode = 24;

    public function onlyLocales(array $locales): static
    {
        $this->onlyLocales = $locales;
        return $this;
    }

    public function weekdaysMin(bool $condition = true): static
    {
        $this->weekdaysMin = $condition;
        return $this;
    }

    public function hourMode(int $mode): static
    {
        $this->hourMode = $mode;
        return $this;
    }

    public function getOnlyLocales(): array
    {
        return $this->onlyLocales;
    }

    public function getWeekdaysMin(): bool
    {
        return $this->weekdaysMin;
    }

    public function getHourMode(): int
    {
        return $this->hourMode;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->extraAttributes([
            'onlyLocales' => $this->getOnlyLocales(),
            'weekdaysMin' => $this->getWeekdaysMin(),
            'hourMode' => $this->getHourMode(),
        ], true);
    }
}