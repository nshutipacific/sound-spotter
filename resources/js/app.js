import './bootstrap';
import { createApp } from "vue";
import App from "./components/App.vue";
import Dashboard from './components/dashboard/Dashboard.vue';

const app = createApp({});
app.component('app', App);
app.component('dashboard', Dashboard);
app.mount("#app");


