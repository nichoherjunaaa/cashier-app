import './bootstrap';

import Alpine from 'alpinejs';
import '../css/app.css';

import Chart from 'chart.js/auto';
import '@fortawesome/fontawesome-free/css/all.min.css';



window.Chart = Chart;
window.Alpine = Alpine;

Alpine.start();
