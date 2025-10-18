<?php

namespace Shreejan\FilamentNepaliDatePicker\Forms\Components;

use Closure;
use Filament\Forms\Components\DatePicker;

class NepaliDatePicker extends DatePicker
{
    protected string $view = 'filament-nepali-date-picker::components.nepali-date-picker';

    private bool|string $onlyLocales = true;
    private bool $weekdaysMin = true;
    private string $mode = 'light';
    private bool $miniEnglishDates = false;
    protected string|Closure|null $displayFormat = 'ne'; // Default: Nepali digits (२०८२-०७-२६)
    
    // Additional options from documentation
    private bool $unicodeDate = true;
    private string $language = 'nepali';
    private bool $inline = false;
    private string $animation = 'slide';
    private bool $range = false;
    private bool $multiple = false;
    private bool $disableToday = false;
    private array $disableDates = [];
    private int|null $disableDaysBefore = null;
    private int|null $disableDaysAfter = null;
    private array|null $nepaliMinDate = null;
    private array|null $nepaliMaxDate = null;
    private string|null $nepaliContainer = null;
    private string|null $nepaliValue = null;

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

    public function displayFormat(string|Closure|null $format): static
    {
        $this->displayFormat = $format;
        $this->extraAttributes(['displayFormat' => $this->displayFormat], false);
        return $this;
    }

    public function nepaliDigits(): static
    {
        $this->displayFormat = 'ne';
        $this->extraAttributes(['displayFormat' => 'ne'], false);
        return $this;
    }

    public function englishDigits(): static
    {
        $this->displayFormat = 'en';
        $this->extraAttributes(['displayFormat' => 'en'], false);
        return $this;
    }

    public function mode(string $mode): static
    {
        $this->mode = $mode;
        $this->extraAttributes(['mode' => $this->mode], false);
        return $this;
    }

    public function miniEnglishDates(bool $miniEnglishDates = true): static
    {
        $this->miniEnglishDates = $miniEnglishDates;
        $this->extraAttributes(['miniEnglishDates' => $this->miniEnglishDates], false);
        return $this;
    }

    public function unicodeDate(bool $unicodeDate = true): static
    {
        $this->unicodeDate = $unicodeDate;
        $this->extraAttributes(['unicodeDate' => $unicodeDate], false);
        return $this;
    }

    public function language(string $language): static
    {
        $this->language = $language;
        $this->extraAttributes(['language' => $language], false);
        return $this;
    }

    public function inline(bool $inline = true): static
    {
        $this->inline = $inline;
        $this->extraAttributes(['inline' => $inline], false);
        return $this;
    }

    public function animation(string $animation): static
    {
        $this->animation = $animation;
        $this->extraAttributes(['animation' => $animation], false);
        return $this;
    }

    public function range(bool $range = true): static
    {
        $this->range = $range;
        $this->extraAttributes(['range' => $range], false);
        return $this;
    }

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;
        $this->extraAttributes(['multiple' => $multiple], false);
        return $this;
    }

    public function disableToday(bool $disableToday = true): static
    {
        $this->disableToday = $disableToday;
        $this->extraAttributes(['disableToday' => $disableToday], false);
        return $this;
    }

    public function disableDates(array $dates): static
    {
        $this->disableDates = $dates;
        $this->extraAttributes(['disableDates' => $dates], false);
        return $this;
    }

    public function disableDaysBefore(int $days): static
    {
        $this->disableDaysBefore = $days;
        $this->extraAttributes(['disableDaysBefore' => $days], false);
        return $this;
    }

    public function disableDaysAfter(int $days): static
    {
        $this->disableDaysAfter = $days;
        $this->extraAttributes(['disableDaysAfter' => $days], false);
        return $this;
    }

    public function nepaliMinDate(int $year, int $month, int $day): static
    {
        $this->nepaliMinDate = ['year' => $year, 'month' => $month, 'day' => $day];
        $this->extraAttributes(['nepaliMinDate' => $this->nepaliMinDate], false);
        return $this;
    }

    public function nepaliMaxDate(int $year, int $month, int $day): static
    {
        $this->nepaliMaxDate = ['year' => $year, 'month' => $month, 'day' => $day];
        $this->extraAttributes(['nepaliMaxDate' => $this->nepaliMaxDate], false);
        return $this;
    }

    public function nepaliContainer(string $container): static
    {
        $this->nepaliContainer = $container;
        $this->extraAttributes(['nepaliContainer' => $container], false);
        return $this;
    }

    public function nepaliDefaultValue(string $value): static
    {
        $this->nepaliValue = $value;
        $this->extraAttributes(['nepaliValue' => $value], false);
        return $this;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->native(false);
        $this->extraAttributes([
            'weekdaysMin' => (int) $this->weekdaysMin,
            'onlyLocales' => is_string($this->onlyLocales) ? $this->onlyLocales : (int) $this->onlyLocales,
            'mode' => $this->mode,
            'miniEnglishDates' => $this->miniEnglishDates,
            'displayFormat' => $this->evaluate($this->displayFormat),
            'unicodeDate' => $this->unicodeDate,
            'language' => $this->language,
            'inline' => $this->inline,
            'animation' => $this->animation,
            'range' => $this->range,
            'multiple' => $this->multiple,
            'disableToday' => $this->disableToday,
            'disableDates' => $this->disableDates,
            'disableDaysBefore' => $this->disableDaysBefore,
            'disableDaysAfter' => $this->disableDaysAfter,
            'nepaliMinDate' => $this->nepaliMinDate,
            'nepaliMaxDate' => $this->nepaliMaxDate,
            'nepaliContainer' => $this->nepaliContainer,
            'nepaliValue' => $this->nepaliValue,
        ], true);
        $this->suffixIcon('heroicon-o-calendar', isInline: true);
    }
}