Vue.component('datepicker', {
    'props': ['date', 'language'],
    'template': '<input type="text" :language="this.language" class="inputCenter" :value="this.date">',
    'mounted': function () {
        $(this.$el).datepicker({
            dateFormat: 'dd/mm/yy',
            showButtonPanel: true,
            onClose: this.onClose,
            changeDate: this.changeDate,
            language: this.language,

        }).on('changeDate', this.onChangeDate)
        .on('hide', this.onChangeDate)
    },
    'methods': {
        onClose(date) {
            this.$emit('input', date.date.toLocaleDateString(this.language))
        },
        onChangeDate(objetoData) {
            this.$emit('input', objetoData.date.toLocaleDateString(this.language))
        }    
    },
    watch: {
        value(newVal) { $(this.el).datepicker('setDate', newVal); }
    }
});