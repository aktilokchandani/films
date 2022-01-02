$("#genre_ids").select2({})
$('input[name="release_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    autoApply: true,
    minYear: 1963,
    locale: {
        format : "YYYY-MM-DD",
    },
    maxYear: parseInt(moment().format('YYYY-MM-DD'),10)
}, function(start, end, label) {
    var years = moment().diff(start, 'years');
});
