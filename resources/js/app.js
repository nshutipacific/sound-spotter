import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';

import { createApp } from "vue";
import App from "./components/App.vue";
import Dashboard from './components/dashboard/Dashboard.vue';
import Navigation from './components/Navigation.vue';
import Artists from './components/dashboard/Artists.vue';
import Albums from './components/dashboard/Albums.vue';
import ArtistModal from './components/ArtistModal.vue';
import AlbumModal from './components/AlbumModal.vue';
import GoogleSignInButton from './components/GoogleSignInButton.vue';
import AlbumView from './components/dashboard/AlbumView.vue';
import ArtistView from './components/dashboard/ArtistView.vue';

const app = createApp({});

app.component('app', App);
app.component('dashboard', Dashboard);
app.component('navigation', Navigation);
app.component('artists', Artists);
app.component('albums', Albums);
app.component('artist-modal', ArtistModal);
app.component('album-modal', AlbumModal);
app.component('google-sign-in-button', GoogleSignInButton);
app.component('album-view', AlbumView);
app.component('artist-view', ArtistView);

app.mount("#app");


