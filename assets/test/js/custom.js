/**
 * Created by permana on 7/2/2017.
 */
$(document).ready(function () {
   // Confirm delete
    $(document.body).on('submit', '.js-confirm', function () {
        var $el = $(this)
        var text = $el.data('confirm')? $el.data('confirm'): 'Anda yakin melakukan tindakan ini?'

        var c = confirm(text);
        return c;
    });


    // add selectize to select element
    $('.js-selectize').selectize({
       sortField:'text'
    });
});