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
    $onlyLocales = $getExtraAttributes()['onlyLocales'] ?? '';
    $weekdaysMin = $getExtraAttributes()['weekdaysMin'] ?? '';
    $dateFormat = $getExtraAttributes()['dateFormat'] ?? '%Y-%m-%d';
@endphp

{{-- Load Nepali Date Picker assets --}}
<style>
    {!! file_get_contents(base_path('packages/shreejan/filament-nepali-date-picker/resources/dist/css/nepali-date-picker.css')) !!}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    {!! file_get_contents(base_path('packages/shreejan/filament-nepali-date-picker/resources/dist/js/nepali-date-picker.js')) !!}
</script>

<x-dynamic-component :component="$fieldWrapperView" :field="$field" :inline-label-vertical-alignment="\Filament\Support\Enums\VerticalAlignment::Center">
    <x-filament::input.wrapper :disabled="$isDisabled" :inline-prefix="$isPrefixInline" :inline-suffix="$isSuffixInline" :prefix="$prefixLabel" :prefix-actions="$prefixActions"
        :prefix-icon="$prefixIcon" :prefix-icon-color="$prefixIconColor" :suffix="$suffixLabel" :suffix-actions="$suffixActions" :suffix-icon="$suffixIcon" :suffix-icon-color="$suffixIconColor"
        :valid="!$errors->has($statePath)" :attributes="\Filament\Support\prepare_inherited_attributes($extraAttributeBag)->class([
            'fi-fo-date-time-picker',
        ])">
        
        <div wire:ignore>
            <input 
                type="text"
                name="{{ $getName() }}"
                id="{{ $getId() }}"
                value=""
                placeholder="Click to select Nepali date"
                @disabled($isDisabled)
                readonly
                class="fi-input block w-full border-none py-1.5 text-base text-gray-950 outline-none placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 cursor-pointer"
                style="cursor: pointer;"
            />
        </div>
    </x-filament::input.wrapper>
</x-dynamic-component>

    <script>
        // Initialize Nepali Date Picker with proper error handling
        setTimeout(function() {
            console.log('Initializing Nepali Date Picker...');
            
            const input = document.getElementById('{{ $getId() }}');
            console.log('Input element:', input);
            
            if (input && typeof $ !== 'undefined' && typeof $.fn.nepaliDatePicker !== 'undefined') {
                console.log('All dependencies available, initializing...');
                
                // Ensure input is completely empty
                $(input).val('');
                
                // Initialize with proper error handling
                try {
                    $(input).nepaliDatePicker({
                        dateFormat: '%D, %M %d, %y',
                        closeOnDateSelect: true,
                        onChange: function(selectedDate) {
                            console.log('Date selected:', selectedDate);
                            if (selectedDate && typeof $wire !== 'undefined') {
                                $wire.set('{{ $getStatePath() }}', selectedDate);
                            }
                        }
                    });
                    console.log('Nepali Date Picker initialized successfully');
                } catch (error) {
                    console.error('Error initializing Nepali Date Picker:', error);
                }
                
            } else {
                console.log('Dependencies not ready:');
                console.log('- jQuery:', typeof $ !== 'undefined');
                console.log('- nepaliDatePicker:', typeof $.fn.nepaliDatePicker !== 'undefined');
                console.log('- Input element:', !!input);
            }
        }, 1000);
    </script>