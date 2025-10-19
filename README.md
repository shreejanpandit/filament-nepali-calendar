# Filament Nepali Date Picker

A Filament PHP package that provides Nepali calendar date picker components for forms and tables.

## Features

- **NepaliDatePicker** - Form component with Nepali calendar support
- **NepaliDateColumn** - Table column with Nepali date display
- **Unicode Support** - Display dates in Nepali Unicode (२०८२-०६-२८)
- **Validation** - Proper BS date validation using calendar data
- **Searchable** - Table columns support search functionality
- **Sortable** - Table columns support sorting

## Installation

```bash
composer require shreejan/filament-nepali-date-picker
```

## Usage

### Form Component

```php
use Shreejan\FilamentNepaliDatePicker\Forms\Components\NepaliDatePicker;

NepaliDatePicker::make('event_date')
    ->required()
    ->label('Event Date')
    ->dateFormat('YYYY-MM-DD')
    ->unicodeDate(true)
    ->mode('light')
    ->miniEnglishDates(true)
    ->language('nepali')
```

### Table Column

```php
use Shreejan\FilamentNepaliDatePicker\Tables\Columns\NepaliDateColumn;

NepaliDateColumn::make('event_date')
    ->label('Event Date')
    ->date()
    ->displayFormat('nepali-numbers')
    ->sortable()
    ->searchable()
```

## Configuration

The package automatically publishes assets and views. No additional configuration is required.

## License

MIT