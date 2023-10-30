//Initialize Bootstrap 5 tooltips
document.addEventListener("DOMContentLoaded", function() {
    const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipEls.forEach(el => new bootstrap.Tooltip(el));
});