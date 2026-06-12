import './bootstrap';
import { createApp } from 'vue';
import Warriors from './components/Warriors.vue';

const el = document.getElementById('app');
if (el) {
    createApp(Warriors).mount(el);
}
