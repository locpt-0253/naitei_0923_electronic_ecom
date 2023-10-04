require('./bootstrap');

window.$ = window.jQuery = require('jquery');
window.Popper = require('@popperjs/core');
require('bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.getElementById('logout-button');
    const form = document.getElementById('logout-form');
    submitButton.addEventListener('click', function () {
        form.submit();
    });
});
