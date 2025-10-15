@php
    $fieldWrapperView = $getFieldWrapperView();
    $datalistOptions = $getDatalistOptions();
    $disabledDates = $getDisabledDates();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $extraAttributeBag = $getExtraAttributeBag();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $hasTime = $hasTime();
    $id = $getId();
    $isDisabled = $isDisabled();
    $isAutofocused = $isAutofocused();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $maxDate = $getMaxDate();
    $minDate = $getMinDate();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixIconColor = $getPrefixIconColor();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixIconColor = $getSuffixIconColor();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
    $placeholder = $getPlaceholder();
    $isReadOnly = $isReadOnly();
    $isRequired = $isRequired();
    $isConcealed = $isConcealed();
    $step = $getStep();
    $type = $getType();
    $livewireKey = $getLivewireKey();
    $extraAttributes = $getExtraAttributes();
    $onlyLocales = $extraAttributes['onlyLocales'] ?? '';
    $weekdaysMin = $extraAttributes['weekdaysMin'] ?? '';
    $dateFormat = $extraAttributes['dateFormat'] ?? '%Y-%m-%d';
@endphp

{{-- Load Nepali Date Picker assets --}}
<link rel="stylesheet" href="{{ asset('vendor/filament-nepali-date-picker/css/nepali-date-picker.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('vendor/filament-nepali-date-picker/js/nepali-date-picker.js') }}"></script>
        <script src="{{ asset('vendor/filament-nepali-date-picker/js/nepali-date-converter.js') }}"></script>

<x-dynamic-component :component="$fieldWrapperView" :field="$field" :inline-label-vertical-alignment="\Filament\Support\Enums\VerticalAlignment::Center">
    <x-filament::input.wrapper :disabled="$isDisabled" :inline-prefix="$isPrefixInline" :inline-suffix="$isSuffixInline" :prefix="$prefixLabel" :prefix-actions="$prefixActions"
        :prefix-icon="$prefixIcon" :prefix-icon-color="$prefixIconColor" :suffix="$suffixLabel" :suffix-actions="$suffixActions" :suffix-icon="$suffixIcon" :suffix-icon-color="$suffixIconColor"
        :valid="!$errors->has($statePath)" :attributes="\Filament\Support\prepare_inherited_attributes($extraAttributeBag)->class([
            'fi-fo-date-time-picker',
        ])">
        
        <div wire:ignore>
            <input 
                type="text"
                name="{{ $getName() }}_display"
                id="{{ $getId() }}_display"
                value=""
                placeholder="Click to select Nepali date"
                @disabled($isDisabled)
                readonly
                class="fi-input block w-full border-none py-1.5 text-base text-gray-950 outline-none placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 cursor-pointer"
                style="cursor: pointer;"
            />
            <input 
                type="hidden"
                name="{{ $getName() }}"
                id="{{ $getId() }}"
                wire:model="{{ $getStatePath() }}"
                value=""
            />
        </div>
    </x-filament::input.wrapper>
</x-dynamic-component>

    <script>
        // Function to convert Nepali date to English date format using proper converter
        function convertNepaliToEnglish(nepaliDate) {
            try {
                // Check if it's already in YYYY-MM-DD format
                if (/^\d{4}-\d{2}-\d{2}$/.test(nepaliDate)) {
                    return nepaliDate;
                }
                
                // Try to parse as Nepali date string (format: "बिही, असोज ३०, २०८२")
                if (nepaliDate.includes(',')) {
                    const parts = nepaliDate.split(', ');
                    if (parts.length >= 3) {
                        const day = parts[1].split(' ')[1]; // Extract day number
                        const month = parts[1].split(' ')[0]; // Extract month name
                        const year = parts[2]; // Extract year
                        
                        // Convert Nepali numbers to English numbers
                        const nepaliYear = convertNepaliToEnglishNumber(year);
                        const nepaliDay = convertNepaliToEnglishNumber(day);
                        
                        // Map Nepali month names to month numbers (1-based for nepali-date-picker.js compatibility)
                        // These must match exactly with nepali-date-picker.js bsMonths array
                        const monthMap = {
                            'बैशाख': 1, 'जेठ': 2, 'असार': 3, 'साउन': 4, 'भदौ': 5, 'असोज': 6,
                            'कार्तिक': 7, 'मंसिर': 8, 'पौष': 9, 'माघ': 10, 'फागुन': 11, 'चैत': 12
                        };
                        
                        // Try to find a partial match if exact match fails
                        let nepaliMonth = monthMap[month];
                        if (!nepaliMonth) {
                            for (const [key, value] of Object.entries(monthMap)) {
                                if (month.includes(key) || key.includes(month)) {
                                    nepaliMonth = value;
                                    break;
                                }
                            }
                        }
                        
                        // Ensure month is valid (1-12)
                        if (nepaliMonth < 1 || nepaliMonth > 12) {
                            nepaliMonth = 1;
                        }
                        
                        // Use the proper NepaliDateConverter
                        if (typeof window.NepaliDateConverter !== 'undefined') {
                            const result = window.NepaliDateConverter.convertToAD({
                                year: nepaliYear,
                                month: nepaliMonth - 1, // Convert to 0-based month for converter
                                date: nepaliDay
                            });
                            
                            const englishDate = `${result.AD.year}-${(result.AD.month + 1).toString().padStart(2, '0')}-${result.AD.date.toString().padStart(2, '0')}`;
                            return englishDate;
                        } else {
                            // Fallback to today's date
                            const today = new Date();
                            return today.toISOString().split('T')[0];
                        }
                    }
                }
                
                // If all else fails, try to use today's date as fallback
                const today = new Date();
                return today.toISOString().split('T')[0];
                
            } catch (error) {
                // Return today's date as fallback
                const today = new Date();
                return today.toISOString().split('T')[0];
            }
        }
        
        
        // Helper function to convert Nepali numbers to English numbers
        function convertNepaliToEnglishNumber(nepaliNumber) {
            const numberMap = {
                '०': 0, '१': 1, '२': 2, '३': 3, '४': 4, '५': 5, '६': 6, '७': 7, '८': 8, '९': 9
            };
            
            let result = '';
            for (let i = 0; i < nepaliNumber.length; i++) {
                const char = nepaliNumber[i];
                if (numberMap[char] !== undefined) {
                    result += numberMap[char];
                } else {
                    result += char;
                }
            }
            return parseInt(result) || 0;
        }
        
        // Add the missing convertToEnglishNumbers function to NepaliDateConverter if not present
        if (typeof window.NepaliDateConverter !== 'undefined' && !window.NepaliDateConverter.convertToEnglishNumbers) {
            window.NepaliDateConverter.convertToEnglishNumbers = convertNepaliToEnglishNumber;
        }
        
        // Helper function to convert English numbers to Nepali numbers
        function convertEnglishToNepaliNumber(englishNumber) {
            const numberMap = {
                0: '०', 1: '१', 2: '२', 3: '३', 4: '४', 5: '५', 6: '६', 7: '७', 8: '८', 9: '९'
            };
            
            return englishNumber.toString().split('').map(digit => numberMap[digit] || digit).join('');
        }
        
        // Helper function to convert English date back to Nepali for display
        function convertEnglishToNepali(englishDate) {
            try {
                // Parse English date (YYYY-MM-DD)
                const parts = englishDate.split('-');
                if (parts.length === 3) {
                    const englishYear = parseInt(parts[0]);
                    const englishMonth = parseInt(parts[1]) - 1; // Convert to 0-based month
                    const englishDay = parseInt(parts[2]);
                    
                    // Use the proper NepaliDateConverter
                    if (typeof window.NepaliDateConverter !== 'undefined') {
                        const result = window.NepaliDateConverter.convertToBS(new Date(englishYear, englishMonth, englishDay));
                        const nepaliDate = window.NepaliDateConverter.format(result.BS, 'ddd, MMMM DD, YYYY', 'np');
                        return nepaliDate;
                    } else {
                        return englishDate; // Return original if converter not available
                    }
                }
            } catch (error) {
                // Return original if conversion fails
            }
            return englishDate;
        }
        
        // Initialize Nepali Date Picker with proper error handling
        function initializeNepaliDatePicker() {
            const displayInput = document.getElementById('{{ $getId() }}_display');
            const hiddenInput = document.getElementById('{{ $getId() }}');
            
            if (displayInput && hiddenInput && typeof $ !== 'undefined' && typeof $.fn.nepaliDatePicker !== 'undefined') {
                // Check for existing value in multiple ways (for edit mode)
                let existingValue = $(hiddenInput).val();
                
                // If no value in hidden input, try to get from Livewire state
                if (!existingValue && typeof $wire !== 'undefined') {
                    try {
                        const statePath = '{{ $getStatePath() }}';
                        existingValue = $wire.get(statePath);
                    } catch (e) {
                        // Ignore errors
                    }
                }
                
                // If still no value, try to get from the input's default value or data attributes
                if (!existingValue) {
                    existingValue = hiddenInput.getAttribute('value') || hiddenInput.getAttribute('data-value');
                }
                
                // If still no value, check if the input has been populated by Filament
                if (!existingValue) {
                    // Wait a bit more for Filament to populate the form
                    setTimeout(() => {
                        existingValue = $(hiddenInput).val();
                        if (existingValue) {
                            initializeWithValue(existingValue);
                        }
                    }, 1000);
                }
                
                // If we have a value, initialize with it
                if (existingValue) {
                    initializeWithValue(existingValue);
                } else {
                    // Initialize without existing value (create mode)
                    initializeWithoutValue();
                }
            }
        }
        
        // Initialize with existing value (edit mode)
        function initializeWithValue(existingValue) {
            const displayInput = document.getElementById('{{ $getId() }}_display');
            const hiddenInput = document.getElementById('{{ $getId() }}');
            
            // Clear the display input completely to prevent parsing errors
            $(displayInput).val('');
            
            // Temporarily remove wire:model to prevent parsing conflicts
            const originalWireModel = $(hiddenInput).attr('wire:model');
            $(hiddenInput).removeAttr('wire:model');
            
            // Set up event handlers with initialization flag
            setupEventHandlers(true);
            
            try {
                // Clean the existing value (remove time part if present)
                const cleanDate = existingValue.split(' ')[0].split('T')[0];
                
                const parts = cleanDate.split('-');
                if (parts.length === 3) {
                    const englishYear = parseInt(parts[0]);
                    const englishMonth = parseInt(parts[1]) - 1; // Convert to 0-based month
                    const englishDay = parseInt(parts[2]);
                    
                    // Use the proper NepaliDateConverter
                    if (typeof window.NepaliDateConverter !== 'undefined') {
                        const result = window.NepaliDateConverter.convertToBS(new Date(englishYear, englishMonth, englishDay));
                        
                        // The converter returns 0-based months (0-11), convert to 1-based for picker
                        let bsMonth = result.BS.month + 1;
                        
                        // Additional validation
                        if (bsMonth < 1) {
                            bsMonth = 1;
                        } else if (bsMonth > 12) {
                            bsMonth = 12;
                        }
                        
                        // Format the Nepali date for display using picker-compatible month names
                        const nepaliMonths = ['बैशाख', 'जेठ', 'असार', 'साउन', 'भदौ', 'असोज', 'कार्तिक', 'मंसिर', 'पौष', 'माघ', 'फागुन', 'चैत'];
                        const nepaliDays = ['आइत', 'सोम', 'मंगल', 'बुध', 'बिही', 'शुक्र', 'शनि'];
                        
                        const dayName = nepaliDays[result.BS.day] || 'बुध';
                        const monthName = nepaliMonths[result.BS.month] || 'भदौ';
                        const nepaliYear = window.NepaliDateConverter.format({year: result.BS.year, month: 0, date: 1}, 'YYYY', 'np');
                        const nepaliDay = window.NepaliDateConverter.format({year: 1, month: 0, date: result.BS.date}, 'DD', 'np');
                        
                        const nepaliDate = `${dayName}, ${monthName} ${nepaliDay}, ${nepaliYear}`;
                        $(displayInput).val(nepaliDate);
                        
                        // Set the hidden input value
                        $(hiddenInput).val(cleanDate);
                        
                        // Initialize the nepali date picker (it will read the display value)
                        const initOptions = {
                            dateFormat: '%D, %M %d, %y',
                            closeOnDateSelect: true
                        };
                        
                        $(displayInput).nepaliDatePicker(initOptions);
                        
                        // Mark initialization as complete after a delay
                        setTimeout(() => {
                            isInitializing = false;
                        }, 1000);
                        
                    } else {
                        // Fallback initialization
                        $(displayInput).nepaliDatePicker({
                            dateFormat: '%D, %M %d, %y',
                            closeOnDateSelect: true
                        });
                        isInitializing = false;
                    }
                } else {
                    // Fallback initialization
                    $(displayInput).nepaliDatePicker({
                        dateFormat: '%D, %M %d, %y',
                        closeOnDateSelect: true
                    });
                    isInitializing = false;
                }
                
                // Restore wire:model after initialization
                if (originalWireModel) {
                    $(hiddenInput).attr('wire:model', originalWireModel);
                }
                
                // Set up event handlers
                setupEventHandlers();
                
            } catch (error) {
                // Fallback initialization on error
                $(displayInput).nepaliDatePicker({
                    dateFormat: '%D, %M %d, %y',
                    closeOnDateSelect: true
                });
                isInitializing = false;
            }
        }
        
        // Initialize without existing value (create mode)
        function initializeWithoutValue() {
            const displayInput = document.getElementById('{{ $getId() }}_display');
            const hiddenInput = document.getElementById('{{ $getId() }}');
            
            // Clear the display input
            $(displayInput).val('');
            
            // Temporarily remove wire:model to prevent parsing conflicts
            const originalWireModel = $(hiddenInput).attr('wire:model');
            $(hiddenInput).removeAttr('wire:model');
            
            try {
                // Simple initialization for create mode
                $(displayInput).nepaliDatePicker({
                    dateFormat: '%D, %M %d, %y',
                    closeOnDateSelect: true
                });
                
                // Restore wire:model after initialization
                if (originalWireModel) {
                    $(hiddenInput).attr('wire:model', originalWireModel);
                }
                
                // Set up event handlers (not edit mode, so no initialization flag needed)
                setupEventHandlers(false);
                
            } catch (error) {
                // Fallback initialization on error
                $(displayInput).nepaliDatePicker({
                    dateFormat: '%D, %M %d, %y',
                    closeOnDateSelect: true
                });
            }
        }
        
        // Set up event handlers for both modes
        function setupEventHandlers(isEditMode = false) {
            const displayInput = document.getElementById('{{ $getId() }}_display');
            const hiddenInput = document.getElementById('{{ $getId() }}');
            
            // Store the last known value to detect changes
            let lastValue = '';
            let isInitializing = isEditMode; // Flag to prevent updates during initialization
            
            // Function to update form state
            function updateFormState(selectedDate) {
                // Skip updates during initialization
                if (isInitializing) {
                    return;
                }
                
                if (selectedDate) {
                    // Convert Nepali date to English date format (YYYY-MM-DD)
                    const englishDate = convertNepaliToEnglish(selectedDate);
                    
                    // Try multiple methods to update the form state
                    try {
                        // Method 1: Try Livewire $wire (most common)
                        if (typeof $wire !== 'undefined') {
                            $wire.set('{{ $getStatePath() }}', englishDate);
                            return;
                        }
                        
                        // Method 2: Try to find Livewire component by ID
                        if (typeof Livewire !== 'undefined') {
                            try {
                                const component = Livewire.find('{{ $getLivewireKey() }}');
                                if (component && component.set) {
                                    component.set('{{ $getStatePath() }}', englishDate);
                                    return;
                                }
                            } catch (e) {
                                // Ignore errors
                            }
                        }
                        
                        // Method 3: Update the hidden input and use Livewire's input event
                        hiddenInput.value = englishDate;
                        
                        // Use Livewire's specific input event
                        if (typeof Livewire !== 'undefined') {
                            hiddenInput.dispatchEvent(new CustomEvent('input', {
                                detail: { value: englishDate },
                                bubbles: true
                            }));
                        }
                        
                        // Also trigger standard events
                        const events = ['input', 'change', 'blur'];
                        events.forEach(eventType => {
                            hiddenInput.dispatchEvent(new Event(eventType, { bubbles: true }));
                        });
                        
                        // Method 4: Try to trigger Livewire update manually
                        setTimeout(() => {
                            if (typeof Livewire !== 'undefined') {
                                try {
                                    Livewire.emit('input', '{{ $getStatePath() }}', englishDate);
                                } catch (e) {
                                    // Ignore errors
                                }
                            }
                        }, 100);
                        
                } catch (error) {
                        // Ignore errors
                    }
                }
            }
            
            // Polling method to detect value changes
            function checkForValueChange() {
                const currentValue = $(displayInput).val();
                if (currentValue && currentValue !== lastValue) {
                    lastValue = currentValue;
                    updateFormState(currentValue);
                }
            }
            
            // Start polling every 500ms
            const pollInterval = setInterval(checkForValueChange, 500);
            
            // Listen for various events as backup
            $(displayInput).on('change keyup input', function() {
                const value = $(this).val();
                if (value && value !== lastValue) {
                    lastValue = value;
                    updateFormState(value);
                }
            });
            
            // Clean up polling when page unloads
            $(window).on('beforeunload', function() {
                clearInterval(pollInterval);
            });
        }
        
        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initializeNepaliDatePicker, 500);
        });
        
        // Also initialize on Livewire updates
        document.addEventListener('livewire:load', function() {
            setTimeout(initializeNepaliDatePicker, 500);
        });
        
        document.addEventListener('livewire:update', function() {
            setTimeout(initializeNepaliDatePicker, 100);
        });
    </script>