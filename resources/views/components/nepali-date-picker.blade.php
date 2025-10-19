@php
    $statePath = $getStatePath();
    $isDisabled = $isDisabled();
    $isRequired = $isRequired();
    $livewireKey = $getLivewireKey();
@endphp

{{-- Load Nepali Date Picker assets --}}
<link rel="stylesheet" href="{{ asset('vendor/filament-nepali-date-picker/css/nepali-date-picker.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('vendor/filament-nepali-date-picker/js/nepali-date-picker.js') }}"></script>
<script src="{{ asset('vendor/filament-nepali-date-picker/js/nepali-date-converter.js') }}"></script>

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" :inline-label-vertical-alignment="\Filament\Support\Enums\VerticalAlignment::Center">
    <x-filament::input.wrapper :disabled="$isDisabled" :valid="!$errors->has($statePath)" class="fi-fo-nepali-date-picker">
        
        <div wire:ignore>
            <input 
                type="text"
                name="{{ $getName() }}_display"
                id="{{ $getId() }}_display"
                value="{{ $getState() }}"
                placeholder="Select Nepali Date"
                @disabled($isDisabled)
                readonly
                class="fi-input block w-full border-none py-1.5 text-base text-gray-950 outline-none placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 cursor-pointer"
                style="cursor: pointer;"
            />
            <input 
                type="hidden"
                name="{{ $getName() }}"
                id="{{ $getId() }}"
                wire:model.live="{{ $getStatePath() }}"
                value="{{ $getState() }}"
            />
        </div>
    </x-filament::input.wrapper>
</x-dynamic-component>

<script>
    $(document).ready(function() {
        const displayInput = $('input[name="{{ $getName() }}_display"]');
        const hiddenInput = $('input[name="{{ $getName() }}"]');
        
        // Get current value from hidden input
        const currentValue = hiddenInput.val();
        console.log('Current hidden value:', currentValue);
        
        // Clean the value if it has time part
        let cleanValue = currentValue;
        if (currentValue && currentValue.includes(' ')) {
            cleanValue = currentValue.split(' ')[0];
            console.log('Cleaned value (removed time):', cleanValue);
        }
        
        // Initialize picker with simple options
        const pickerOptions = {
            dateFormat: 'YYYY-MM-DD',
            mode: 'light',
            miniEnglishDates: true,
            unicodeDate: true,
            closeOnDateSelect: true,
            onSelect: function(date) {
                console.log('Date selected:', date);
                
                if (date && date.value) {
                    // Update hidden input with English format (for database)
                    hiddenInput.val(date.value);
                    console.log('Updated hidden input with:', date.value);
                    
                    // Update Livewire state with multiple methods
                    try {
                        // Method 1: Direct $wire.set
                        if (typeof $wire !== 'undefined') {
                            $wire.set('{{ $getStatePath() }}', date.value);
                            console.log('Updated Livewire with $wire.set:', date.value);
                        }
                        
                        // Method 2: Trigger input events on hidden input
                        hiddenInput[0].dispatchEvent(new Event('input', { bubbles: true }));
                        hiddenInput[0].dispatchEvent(new Event('change', { bubbles: true }));
                        console.log('Triggered input events');
                        
                        // Method 3: Force Livewire refresh
                        setTimeout(function() {
                            if (typeof Livewire !== 'undefined') {
                                Livewire.dispatch('refresh');
                                console.log('Dispatched Livewire refresh');
                            }
                        }, 100);
                        
                    } catch (error) {
                        console.error('Error updating Livewire:', error);
                    }
                }
            }
        };
        
        // If we have a value, add it to picker options
        if (cleanValue && cleanValue.trim() !== '') {
            console.log('Setting initial value:', cleanValue);
            pickerOptions.value = cleanValue;
        }
        
        // Initialize the picker
        displayInput.NepaliDatePicker(pickerOptions);
        
        // If we have an initial value, manually convert it to Unicode format for display
        if (cleanValue && cleanValue.trim() !== '') {
            // Convert English digits to Unicode format for display
            const unicodeValue = cleanValue.replace(/\d/g, function(digit) {
                return String.fromCharCode(parseInt(digit) + 0x0966);
            });
            displayInput.val(unicodeValue);
            console.log('Converted initial value to Unicode:', unicodeValue);
        }
    });
</script>