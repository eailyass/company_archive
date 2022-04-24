import "bootstrap-datepicker"

import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';

jQuery(function ($) {
    $('.date-picker').datepicker({
        format: "yyyy-mm-dd"
    });
})