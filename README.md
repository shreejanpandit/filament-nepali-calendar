# Filament Nepali Date Picker

A Filament PHP package that provides Nepali calendar date picker components for forms and tables. This package integrates the [nepali-date-picker](https://github.com/leapfrogtechnology/nepali-date-picker/) jQuery plugin with Filament's form components.

## Features

- 🇳🇵 **Nepali Calendar Support**: Full support for Bikram Sambat (BS) calendar
- 📅 **Date Picker Component**: Custom Nepali date picker for forms
- 🕐 **DateTime Picker Component**: Nepali date and time picker
- 📊 **Table Column**: Nepali date column for tables
- 🎨 **Customizable**: Configurable date formats and locales
- 🔧 **Easy Integration**: Drop-in replacement for Filament date components

## Installation

```bash
composer require shreejan/filament-nepali-date-picker
```

## Usage

### Form Components

#### NepaliDatePicker

```php
use Shreejan\FilamentNepaliDatePicker\Forms\Components\NepaliDatePicker;

NepaliDatePicker::make('birth_date')
    ->label('Nepali Birth Date')
    ->dateFormat('%Y-%m-%d')
    ->closeOnDateSelect(true)
    ->onlyLocales(['ne', 'np']); // Show only for Nepali locales
```

#### NepaliDateTimePicker

```php
use Shreejan\FilamentNepaliDatePicker\Forms\Components\NepaliDateTimePicker;

NepaliDateTimePicker::make('event_datetime')
    ->label('Event Date & Time')
    ->hourMode(24) // 12 or 24 hour format
    ->weekdaysMin(true);
```

### Table Columns

```php
use Shreejan\FilamentNepaliDatePicker\Tables\Columns\NepaliDateColumn;

NepaliDateColumn::make('created_at')
    ->label('Created Date')
    ->dateFormat('%D, %M %d, %y')
    ->weekdaysMin(true);
```

### Using with Regular Filament Components

You can also add Nepali functionality to regular Filament date components:

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date')
    ->nepali(['ne', 'np'], true); // locales, weekdaysMin
```

## Configuration

### Date Format Options

- `%Y` - Full year (e.g., २०८१)
- `%y` - Year in Nepali numerals
- `%M` - Month name (e.g., बैशाख)
- `%m` - Month number in Nepali numerals
- `%D` - Day name (e.g., सोम)
- `%d` - Date in Nepali numerals

### Available Methods

#### NepaliDatePicker
- `dateFormat(string $format)` - Set date format
- `closeOnDateSelect(bool $condition)` - Close picker on date selection
- `onlyLocales(array $locales)` - Show only for specific locales

#### NepaliDateTimePicker
- `hourMode(int $mode)` - Set hour format (12 or 24)
- `weekdaysMin(bool $condition)` - Show abbreviated weekdays
- `onlyLocales(array $locales)` - Show only for specific locales

## Requirements

- PHP 8.2+
- Filament 4.0+
- Laravel 12.0+

## License

MIT

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Credits

- Based on [nepali-date-picker](https://github.com/leapfrogtechnology/nepali-date-picker/) by Leapfrog Technology
- Built for [Filament PHP](https://filamentphp.com/)