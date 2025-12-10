// assets/js/main.js

document.addEventListener('DOMContentLoaded', function() {
    console.log('Shivhare Bangle Store Loaded');

    // Example: Add smooth scroll to anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
