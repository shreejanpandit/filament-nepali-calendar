@php
    use Shreejan\FilamentNepaliDatePicker\Helpers\NepaliDateConverter;
    
    $dateValue = $getState();
    $dateFormat = $getDateFormat();
    $weekdaysMin = $getWeekdaysMin();
    $displayFormat = $getDisplayFormat();
    
    // Use the converter's built-in method for consistent formatting
    $nepaliDate = NepaliDateConverter::formatNepaliDate($dateValue, $displayFormat);
@endphp

@if($dateValue && $nepaliDate)
    <div class="nepali-date-column">
        @if($dateFormat === 'dateTime')
            {{-- Display both date and time --}}
            <div class="text-sm">
                <div class="font-medium">{{ $nepaliDate }}</div>
                <div class="text-gray-500">{{ \Carbon\Carbon::parse($dateValue)->format('h:i A') }}</div>
            </div>
        @else
            {{-- Display Nepali date only --}}
            <div class="text-sm font-medium">
                {{ $nepaliDate }}
            </div>
        @endif
    </div>
@elseif($dateValue)
    {{-- Fallback to English date if conversion fails --}}
    <div class="text-sm font-medium">
        {{ \Carbon\Carbon::parse($dateValue)->format('M d, Y') }}
    </div>
@else
    <span class="text-gray-400">—</span>
@endif

