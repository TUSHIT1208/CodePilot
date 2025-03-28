(function (window, document, undefined) {
    'use strict';

    // Check if localStorage is supported
    if (!('localStorage' in window)) return;

    // Retrieve night mode state
    var nightMode = localStorage.getItem('gmtNightMode');
    if (nightMode) {
        document.documentElement.classList.add('night-mode');
    }

    // Select the night mode toggle button
    var nightModeToggle = document.querySelector('#night-mode');
    if (!nightModeToggle) return;

    // Append sun icon dynamically
    var modeIcon = nightModeToggle.querySelector('i');
    var sunIcon = document.createElement('i');
    sunIcon.classList.add('uil', 'uil-sun', 'mode-icon');
    modeIcon.parentNode.appendChild(sunIcon); // Add sun icon next to moon

    // Toggle dark mode and icon visibility
    nightModeToggle.addEventListener('click', function (event) {
        event.preventDefault();
        document.documentElement.classList.toggle('night-mode');

        // Store or remove night mode preference
        if (document.documentElement.classList.contains('night-mode')) {
            localStorage.setItem('gmtNightMode', true);
        } else {
            localStorage.removeItem('gmtNightMode');
        }
    });

})(window, document);