<template>
    <div class="bg-gray-900 m-2 rounded p-2">
        <div class="w-full py-4">
            <div class="w-full items-center justify-center flex text-white text-2xl font-black">Sound Spotter Albums
            </div>
            <div class="w-full items-center justify-center flex text-sm">... Search you Favourite Albums</div>
        </div>
        <div class="bg-gray-400 flex p-2 rounded">
            <div class="text-gray-900"> <i class="fa fa-search" aria-hidden="true"></i></div>
            <input type="text" v-model="albumToSearch"
                class="font-bold ml-2 w-full bg-gray-400 text-gray-900 outline-none" @keyup="handleAlbumSearch">
        </div>
        <div v-if="isLoadingAlbums" class="bg-green-300 text-gray-900 font-bold p-2 text-xs mt-2 rounded">
            Getting data ...
        </div>
        <div class="flex flex-wrap h-full h-screen overflow-y-auto">
            <div v-for="album in  albums " :key="album.id"  class="md:w-1/4 xs:w-full sm:w-full relative m-2 cursor-pointer">
                <div v-if="album" class="rounded">
                    <div class="flex" @click="openModal(album.artist, album.name)">
                        <div class="relative flex items-center justify-center">
                            <img class="rounded h-full" :src="album.image[2]['#text']" alt="">
                            <div class="absolute h-full w-full opacity-35 bg-gray-900 hover:bg-green-500"></div>
                            <div
                                class="absolute max-h-1/3 w-full bottom-0 text-gray-800 text-xs font-medium shadow bg-white px-2 py-1 rounded-b">
                                <div class="whitespace-nowrap overflow-hidden text-sm overflow-ellipsis">{{ album.name
                                    }}</div>
                                <div
                                    class="whitespace-nowrap overflow-hidden font-bold text-gray-600 overflow-ellipsis">
                                    <i class="fa-solid fa-play"></i> {{ album.artist }}</div>
                            </div>
                            <div
                                class="absolute top-0 right-0 mr-2 mt-2 text-white hover:text-gray-300 rounded-full font-normal text-2xl cursor-pointer">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <album-modal @componentClosed="closeModal" v-if="openModalOnView" :showModal="showModal" :artistName="artistName" :albumName="albumName" />
</template>

<script>
import AlbumModal from '../AlbumModal.vue';

export default {
    components: { AlbumModal },
    data() {
        return {
            albums: [],
            albumToSearch: '',
            cancelToken: null,
            artistName: '',
            albumName: '',
            openModalOnView: false,
            showModal: true,
            isLoadingAlbums: false
        };
    },
    methods: {
        handleAlbumSearch() {
            this.albums = [];

            this.isLoadingAlbums = true;

            if (this.cancelToken) {
                this.cancelToken.cancel();
            }

            this.cancelToken = axios.CancelToken.source();

            axios.get('/api/albums', {
                params: {
                    album: this.albumToSearch
                },
                cancelToken: this.cancelToken.token
            }).then(response => {
                this.albums = [];
                this.albums = response.data.results.albummatches.album;
                this.isLoadingAlbums = false;
            });
        },
        formatListeners(listeners) {
            return parseInt(listeners).toLocaleString();
        },
        openModal(artistName, albumName) {
            this.artistName = artistName;
            this.albumName = albumName;
            this.openModalOnView = true;
        },
        closeModal() {
            this.openModalOnView = false;
        },
    },
    mounted() {
        this.isLoadingAlbums = true;
        axios.get('/api/albums').then(response => {
            this.albums = [];
            this.albums = response.data.results.albummatches.album;
            this.isLoadingAlbums = false;
        });
    }
};
</script>