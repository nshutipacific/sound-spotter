import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';

import { createApp } from "vue";
import App from "./components/App.vue";
import Dashboard from './components/dashboard/Dashboard.vue';
import Navigation from './components/Navigation.vue';
import Artists from './components/dashboard/Artists.vue';
import Albums from './components/dashboard/Albums.vue';
import InformationModal from './components/InformationModal.vue';

const app = createApp({});
app.component('app', App);
app.component('dashboard', Dashboard);
app.component('navigation', Navigation);
app.component('artists', Artists);
app.component('albums', Albums);
app.component('information-modal', InformationModal);

app.mount("#app");


