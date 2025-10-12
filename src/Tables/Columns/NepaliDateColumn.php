<?php

namespace Shreejan\FilamentNepaliDatePicker\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class NepaliDateColumn extends TextColumn
{
    protected string $view = 'filament-nepali-date-picker::components.nepali-date-column';

    protected string $dateFormat = '%Y-%m-%d';
    protected bool $weekdaysMin = true;

    public function dateFormat(string $format): static
    {
        $this->dateFormat = $format;
        return $this;
    }

    public function weekdaysMin(bool $condition = true): static
    {
        $this->weekdaysMin = $condition;
        return $this;
    }

    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    public function getWeekdaysMin(): bool
    {
        return $this->weekdaysMin;
    }

    public function getOptions(): array
    {
        return [
            'dateFormat' => $this->getDateFormat(),
            'weekdaysMin' => $this->getWeekdaysMin(),
        ];
    }
}
