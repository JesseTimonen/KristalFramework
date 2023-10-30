//Initialize Bootstrap 5 tooltips
$(document).ready(function() {
    var kristal_tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var kristal_tooltipList = kristal_tooltipTriggerList.map(function (kristal_tooltipTriggerEl) {
        return new bootstrap.Tooltip(kristal_tooltipTriggerEl);
    });
});