
$(document).ready(() => {
    $('.noselect img, .noselect a').on('dragstart', function (event) {
        event.preventDefault();
    });
});