@php
    $dateValue = $getState();
    $dateFormat = $getDateFormat();
    $weekdaysMin = $getWeekdaysMin();
@endphp

@if($dateValue)
    <div class="nepali-date-column">
        @if($dateFormat === 'dateTime')
            {{-- Display both date and time --}}
            <div class="text-sm">
                <div class="font-medium">{{ \Carbon\Carbon::parse($dateValue)->format('M d, Y') }}</div>
                <div class="text-gray-500">{{ \Carbon\Carbon::parse($dateValue)->format('h:i A') }}</div>
            </div>
        @else
            {{-- Display date only --}}
            <div class="text-sm font-medium">
                {{ \Carbon\Carbon::parse($dateValue)->format('M d, Y') }}
            </div>
        @endif
    </div>
@else
    <span class="text-gray-400">—</span>
@endif

