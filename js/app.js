$(document).ready(function () {
    $('#converter_form').on('submit', validate);
});

function validate(e) {
    var fields = ['from_currency', 'from_currency_amount', 'to_currency'];
    var input;
    for (var x = 0; x < fields.length; x++) {
        input = $('#' + fields[x]);
        if (input.val() == undefined || input.val() == 0) {
            alert('"' + input.attr('data-name') + '" is required!');
            input.focus();
            e.preventDefault();
            return false;
        }
    }
}
