@php
    $statePath = $getStatePath();
    $isDisabled = $isDisabled();
@endphp

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
        
        const currentValue = hiddenInput.val();
        let cleanValue = currentValue;
        if (currentValue && currentValue.includes(' ')) {
            cleanValue = currentValue.split(' ')[0];
        }
        
        const isDark = document.documentElement.classList.contains('dark') || 
                      document.body.classList.contains('dark');
        
        const pickerOptions = {
            dateFormat: '{{ $getDateFormat() }}',
            mode: isDark ? 'dark' : '{{ $getMode() }}',
            miniEnglishDates: {{ $getMiniEnglishDates() ? 'true' : 'false' }},
            unicodeDate: {{ $getUnicodeDate() ? 'true' : 'false' }},
            closeOnDateSelect: true,
            onSelect: function(date) {
                if (date && date.value) {
                    hiddenInput.val(date.value);
                    try {
                        if (typeof $wire !== 'undefined') {
                            $wire.set('{{ $getStatePath() }}', date.value);
                        }
                        hiddenInput[0].dispatchEvent(new Event('input', { bubbles: true }));
                        hiddenInput[0].dispatchEvent(new Event('change', { bubbles: true }));
                        setTimeout(function() {
                            if (typeof Livewire !== 'undefined') {
                                Livewire.dispatch('refresh');
                            }
                        }, 100);
                    } catch (error) {
                        console.error('Error updating Livewire:', error);
                    }
                }
            }
        };
        
        if (cleanValue && cleanValue.trim() !== '') {
            pickerOptions.value = cleanValue;
        }
        displayInput.NepaliDatePicker(pickerOptions);
        
        if (cleanValue && cleanValue.trim() !== '') {
            const unicodeValue = cleanValue.replace(/\d/g, function(digit) {
                return String.fromCharCode(parseInt(digit) + 0x0966);
            });
            displayInput.val(unicodeValue);
        }
    });
</script>