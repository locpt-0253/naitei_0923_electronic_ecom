require('./bootstrap');

window.$ = window.jQuery = require('jquery');
window.Popper = require('@popperjs/core');
require('bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
