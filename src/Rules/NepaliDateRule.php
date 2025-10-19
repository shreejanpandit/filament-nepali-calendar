<?php

namespace Shreejan\FilamentNepaliDatePicker\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NepaliDateRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            return;
        }
        
        // Check if it's a BS date format (YYYY-MM-DD with year 2000-2100)
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value, $matches)) {
            $year = (int) $matches[1];
            
            // If it's a BS year (2000-2100), it's automatically valid
            if ($year >= 2000 && $year <= 2100) {
                return; // Valid BS date - no further validation needed
            }
        }
        
        // For non-BS dates, validate as normal date
        if (!strtotime($value)) {
            $fail("The date {$value} is not a valid date format.");
        }
    }
}
