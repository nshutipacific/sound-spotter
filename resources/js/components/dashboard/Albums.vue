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
        <div class="flex flex-wrap">
            <div v-for="album in  albums " :key="album.id" class="w-1/4 relative m-2 cursor-pointer">
                <div v-if="album" class="rounded">
                    <div class="flex" @click="openModal(album.mbid)">
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
    <information-modal @componentClosed="closeModal" v-if="openModalOnView" :showModal="showModal" :albumMbid="mbid" />
</template>

<script>
import InformationModal from '../ArtistModal.vue';

export default {
    components: { InformationModal },
    data() {
        return {
            albums: [],
            albumToSearch: '',
            cancelToken: null,
            mbid: '',
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
        openModal(mbid) {
            this.mbid = mbid;
            this.openModalOnView = true;
        },
        closeModal() {
            this.openModalOnView = false;
        },
    },
    mounted() {
        this.isLoadingAlbums = true;
        axios.get('/api/albums').then(response => {
            console.log(response)
            this.albums = [];
            this.albums = response.data.results.albummatches.album;
            this.isLoadingAlbums = false;
        });
    }
};
</script>