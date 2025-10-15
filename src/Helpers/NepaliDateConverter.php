<?php

namespace Shreejan\FilamentNepaliDatePicker\Helpers;

class NepaliDateConverter
{
    /**
     * Convert English date to Nepali date using the same logic as our JavaScript converter
     */
    public static function convertToBS($englishDate)
    {
        $date = \Carbon\Carbon::parse($englishDate);
        $year = $date->year;
        $month = $date->month - 1; // Convert to 0-based month
        $day = $date->day;
        
        // Use the same conversion logic as our JavaScript converter
        $bsYear = $year + 57; // Approximate conversion
        $bsMonth = $month + 1; // Convert back to 1-based
        $bsDay = $day;
        
        // Adjust for month differences (rough approximation)
        if ($month >= 3) { // April onwards
            $bsYear = $year + 57;
            $bsMonth = $month - 2;
        } else { // Jan-Mar
            $bsYear = $year + 56;
            $bsMonth = $month + 10;
        }
        
        // Ensure month is in range 1-12
        if ($bsMonth > 12) {
            $bsMonth -= 12;
            $bsYear += 1;
        } elseif ($bsMonth < 1) {
            $bsMonth += 12;
            $bsYear -= 1;
        }
        
        return [
            'year' => $bsYear,
            'month' => $bsMonth,
            'day' => $bsDay
        ];
    }
    
    /**
     * Convert English numbers to Nepali numbers
     */
    public static function convertToNepaliNumbers($number)
    {
        $nepaliNumbers = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        $result = '';
        $numberStr = (string) $number;
        for ($i = 0; $i < strlen($numberStr); $i++) {
            $digit = (int) $numberStr[$i];
            $result .= $nepaliNumbers[$digit] ?? $numberStr[$i];
        }
        return $result;
    }
    
    /**
     * Format Nepali date in different formats
     */
    public static function formatNepaliDate($englishDate, $format = 'nepali-numbers')
    {
        $bsDate = self::convertToBS($englishDate);
        $date = \Carbon\Carbon::parse($englishDate);
        
        switch ($format) {
            case 'nepali-numbers':
                // Format: २०८२-०५-२९
                return self::convertToNepaliNumbers($bsDate['year']) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['month'], 2, '0', STR_PAD_LEFT)) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['day'], 2, '0', STR_PAD_LEFT));
                       
            case 'english-numbers':
                // Format: 2082-05-29
                return $bsDate['year'] . '-' . str_pad($bsDate['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($bsDate['day'], 2, '0', STR_PAD_LEFT);
                
            case 'nepali-text':
                // Format: बुध, असोज २९, २०८२
                $dayNames = ['आइत', 'सोम', 'मंगल', 'बुध', 'बिही', 'शुक्र', 'शनि'];
                $nepaliMonths = [
                    1 => 'बैशाख', 2 => 'जेठ', 3 => 'असार', 4 => 'साउन', 5 => 'भदौ', 6 => 'असोज',
                    7 => 'कार्तिक', 8 => 'मंसिर', 9 => 'पौष', 10 => 'माघ', 11 => 'फागुन', 12 => 'चैत'
                ];
                
                $dayName = $dayNames[$date->dayOfWeek] ?? 'बुध';
                $monthName = $nepaliMonths[$bsDate['month']] ?? 'असोज';
                return "{$dayName}, {$monthName} " . self::convertToNepaliNumbers($bsDate['day']) . ", " . self::convertToNepaliNumbers($bsDate['year']);
                
            default:
                return self::convertToNepaliNumbers($bsDate['year']) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['month'], 2, '0', STR_PAD_LEFT)) . '-' . 
                       self::convertToNepaliNumbers(str_pad($bsDate['day'], 2, '0', STR_PAD_LEFT));
        }
    }
}
