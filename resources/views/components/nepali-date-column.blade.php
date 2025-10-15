@php
    use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
    
    $dateValue = $getState();
    $dateFormat = $getDateFormat();
    $weekdaysMin = $getWeekdaysMin();
    $displayFormat = $getDisplayFormat();
    
    $nepaliDate = null;
    if ($dateValue) {
        try {
            // Convert English date to Nepali date based on display format
            switch ($displayFormat) {
                case 'nepali-numbers':
                    // Format: २०८२-०५-२९
                    $nepaliDate = LaravelNepaliDate::from($dateValue)->toNepaliDate('Y-m-d', 'np');
                    break;
                case 'english-numbers':
                    // Format: 2082-05-29
                    $nepaliDate = LaravelNepaliDate::from($dateValue)->toNepaliDate('Y-m-d');
                    break;
                case 'nepali-text':
                    // Format: बुध, असोज २९, २०८२
                    $bsDate = LaravelNepaliDate::from($dateValue);
                    $bsYear = $bsDate->toNepaliDate('Y', 'np');
                    $bsMonth = $bsDate->toNepaliDate('m', 'np');
                    $bsDay = $bsDate->toNepaliDate('d', 'np');
                    
                    // Get English date for day of week
                    $englishDate = \Carbon\Carbon::parse($dateValue);
                    
                    // Get BS month number (1-12)
                    $bsMonthNum = (int) $bsDate->toNepaliDate('m');
                    
                    // Map month numbers to Nepali month names (same as picker)
                    $nepaliMonths = [
                        1 => 'बैशाख', 2 => 'जेठ', 3 => 'असार', 4 => 'साउन', 5 => 'भदौ', 6 => 'असोज',
                        7 => 'कार्तिक', 8 => 'मंसिर', 9 => 'पौष', 10 => 'माघ', 11 => 'फागुन', 12 => 'चैत'
                    ];
                    
                    // Get day name (0=Sunday, 1=Monday, etc.)
                    $dayNames = ['आइत', 'सोम', 'मंगल', 'बुध', 'बिही', 'शुक्र', 'शनि'];
                    $dayName = $dayNames[$englishDate->dayOfWeek] ?? 'बुध';
                    
                    $monthName = $nepaliMonths[$bsMonthNum] ?? 'असोज';
                    $nepaliDate = "{$dayName}, {$monthName} {$bsDay}, {$bsYear}";
                    break;
                default:
                    $nepaliDate = LaravelNepaliDate::from($dateValue)->toNepaliDate('Y-m-d', 'np');
            }
        } catch (Exception $e) {
            // Fallback to original date if conversion fails
            $nepaliDate = null;
        }
    }
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

