import "bootstrap-datepicker"

import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';

jQuery(function ($) {
    $('.date-picker').datepicker({
        format: "yyyy-mm-dd"
    });

    var $wrapper = $(".address-wrapper");

    $wrapper.on('click', '.add-address', function(e) {
        e.preventDefault();
        // Get the data-prototype explained earlier
        var prototype = $(this).data('prototype');
        // get the new index
        var index = $(this).data('index');
        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);
        // increase the index with one for the next item
        $(this).data('index', index + 1);
        // Display the form in the page before the "new" link
        $(this).parent().parent().append(newForm);
    });

    $wrapper.on('click', '.delete-address', function(e) {
        e.preventDefault();
        $(this).closest('.address-element')
            .fadeOut()
            .remove();
    });
})