// Simple Alpine.js wrapper for Nepali Date Picker
export default function nepaliDateTimePickerFormComponent(config) {
    return {
        state: config.state,
        displayText: '',
        options: config.options || {},
        isInitialized: false,

        init() {
            this.$nextTick(() => {
                this.initializeNepaliDatePicker();
            });

            // Watch for state changes
            this.$watch('state', (value) => {
                if (value && this.isInitialized) {
                    this.displayText = this.formatDateForDisplay(value);
                }
            });
        },

        initializeNepaliDatePicker() {
            if (this.isInitialized || typeof window.nepaliDatePicker === 'undefined') return;

            const input = this.$refs.input;
            
            // Initialize the nepali date picker
            $(input).nepaliDatePicker({
                dateFormat: this.options.dateFormat || '%Y-%m-%d',
                closeOnDateSelect: this.options.closeOnDateSelect !== false,
                onChange: (selectedDate) => {
                    this.handleDateChange(selectedDate);
                }
            });

            this.isInitialized = true;

            // Set initial value if exists
            if (this.state) {
                this.displayText = this.formatDateForDisplay(this.state);
                $(input).val(this.displayText);
            }
        },

        handleDateChange(nepaliDate) {
            if (nepaliDate) {
                this.displayText = nepaliDate;
                // For now, store the Nepali date as string
                // You can enhance this with proper conversion later
                this.state = nepaliDate;
            } else {
                this.state = null;
                this.displayText = '';
            }
        },

        formatDateForDisplay(dateString) {
            // Simple formatting - you can enhance this with proper conversion later
            if (!dateString) return '';
            
            try {
                const date = new Date(dateString);
                // Simple conversion to Nepali year (approximate)
                const nepaliYear = date.getFullYear() + 56;
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                
                return `${nepaliYear}-${month}-${day}`;
            } catch (e) {
                return dateString;
            }
        },

        clearState() {
            this.state = null;
            this.displayText = '';
            if (this.$refs.input) {
                $(this.$refs.input).val('');
            }
        }
    };
}

// Load jQuery and nepaliDatePicker if not already loaded
if (typeof jQuery === 'undefined') {
    console.warn('jQuery is required for Nepali Date Picker');
}

if (typeof window.nepaliDatePicker === 'undefined') {
    console.warn('nepaliDatePicker is not loaded. Make sure to include the script.');
}