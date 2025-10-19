<?php

namespace Shreejan\FilamentNepaliDatePicker\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;
use Shreejan\FilamentNepaliDatePicker\Rules\NepaliDateRule;

class NepaliDatePicker extends Field
{
    protected string $view = 'filament-nepali-date-picker::components.nepali-date-picker';

    protected bool|string $onlyLocales = true;
    protected bool $weekdaysMin = true;
    protected string $mode = 'light';
    protected bool $miniEnglishDates = false;
    protected string|Closure|null $displayFormat = 'ne'; // Default: Nepali digits (२०८२-०७-२६)
    
    // Additional options from documentation
    protected bool $unicodeDate = true;
    protected string $language = 'nepali';
    protected bool $inline = false;
    protected string $animation = 'slide';
    protected bool $range = false;
    protected bool $multiple = false;
    protected bool $disableToday = false;
    protected array $disableDates = [];
    protected int $disableDaysBefore = 0;
    protected int $disableDaysAfter = 0;
    protected string $dateFormat = 'YYYY-MM-DD';
    protected ?string $minDate = null;
    protected ?string $maxDate = null;
    protected ?Closure $onSelect = null;
    protected ?Closure $onClose = null;


    public function onlyLocales(bool|string $onlyLocales): static
    {
        $this->onlyLocales = $onlyLocales;
        $this->extraAttributes(['onlyLocales' => is_string($onlyLocales) ? $onlyLocales : (int) $onlyLocales], false);
        return $this;
    }

    public function weekdaysMin(bool $weekdaysMin): static
    {
        $this->weekdaysMin = $weekdaysMin;
        $this->extraAttributes(['weekdaysMin' => (int) $weekdaysMin], false);
        return $this;
    }

    public function mode(string $mode): static
    {
        $this->mode = $mode;
        $this->extraAttributes(['mode' => $mode], false);
        return $this;
    }

    public function miniEnglishDates(bool $miniEnglishDates): static
    {
        $this->miniEnglishDates = $miniEnglishDates;
        $this->extraAttributes(['miniEnglishDates' => (int) $miniEnglishDates], false);
        return $this;
    }

    public function displayFormat(string|Closure|null $format): static
    {
        $this->displayFormat = $format;
        $this->extraAttributes(['displayFormat' => $format], false);
        return $this;
    }

    public function unicodeDate(bool $unicodeDate): static
    {
        $this->unicodeDate = $unicodeDate;
        $this->extraAttributes(['unicodeDate' => (int) $unicodeDate], false);
        return $this;
    }

    public function language(string $language): static
    {
        $this->language = $language;
        $this->extraAttributes(['language' => $language], false);
        return $this;
    }

    public function inline(bool $inline): static
    {
        $this->inline = $inline;
        $this->extraAttributes(['inline' => (int) $inline], false);
        return $this;
    }

    public function animation(string $animation): static
    {
        $this->animation = $animation;
        $this->extraAttributes(['animation' => $animation], false);
        return $this;
    }

    public function range(bool $range): static
    {
        $this->range = $range;
        $this->extraAttributes(['range' => (int) $range], false);
        return $this;
    }

    public function multiple(bool $multiple): static
    {
        $this->multiple = $multiple;
        $this->extraAttributes(['multiple' => (int) $multiple], false);
        return $this;
    }

    public function disableToday(bool $disableToday): static
    {
        $this->disableToday = $disableToday;
        $this->extraAttributes(['disableToday' => (int) $disableToday], false);
        return $this;
    }

    public function disableDates(array $disableDates): static
    {
        $this->disableDates = $disableDates;
        $this->extraAttributes(['disableDates' => $disableDates], false);
        return $this;
    }

    public function disableDaysBefore(int $disableDaysBefore): static
    {
        $this->disableDaysBefore = $disableDaysBefore;
        $this->extraAttributes(['disableDaysBefore' => $disableDaysBefore], false);
        return $this;
    }

    public function disableDaysAfter(int $disableDaysAfter): static
    {
        $this->disableDaysAfter = $disableDaysAfter;
        $this->extraAttributes(['disableDaysAfter' => $disableDaysAfter], false);
        return $this;
    }

    public function dateFormat(string $dateFormat): static
    {
        $this->dateFormat = $dateFormat;
        $this->extraAttributes(['dateFormat' => $dateFormat], false);
        return $this;
    }

    public function minDate(?string $minDate): static
    {
        $this->minDate = $minDate;
        $this->extraAttributes(['minDate' => $minDate], false);
        return $this;
    }

    public function maxDate(?string $maxDate): static
    {
        $this->maxDate = $maxDate;
        $this->extraAttributes(['maxDate' => $maxDate], false);
        return $this;
    }

    public function onSelect(?Closure $onSelect): static
    {
        $this->onSelect = $onSelect;
        return $this;
    }

    public function onClose(?Closure $onClose): static
    {
        $this->onClose = $onClose;
        return $this;
    }


    protected function setUp(): void
    {
        parent::setUp();
        
        // Add our custom validation that understands BS dates
        $this->rules([
            'required',
            'string',
            new NepaliDateRule(),
        ]);
        
        $this->extraAttributes([
            'weekdaysMin' => (int) $this->weekdaysMin,
            'onlyLocales' => is_string($this->onlyLocales) ? $this->onlyLocales : (int) $this->onlyLocales,
            'mode' => $this->mode,
            'miniEnglishDates' => (int) $this->miniEnglishDates,
            'displayFormat' => $this->displayFormat,
            'unicodeDate' => (int) $this->unicodeDate,
            'language' => $this->language,
            'inline' => (int) $this->inline,
            'animation' => $this->animation,
            'range' => (int) $this->range,
            'multiple' => (int) $this->multiple,
            'disableToday' => (int) $this->disableToday,
            'disableDates' => $this->disableDates,
            'disableDaysBefore' => $this->disableDaysBefore,
            'disableDaysAfter' => $this->disableDaysAfter,
            'dateFormat' => $this->dateFormat,
            'minDate' => $this->minDate,
            'maxDate' => $this->maxDate,
        ], true);
    }
}