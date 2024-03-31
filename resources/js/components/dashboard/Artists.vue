<template>
    <div class="bg-gray-900 m-2 rounded p-2">
        <div class="w-full py-4">
            <div class="w-full items-center justify-center flex text-white text-2xl font-black">Sound Spotter Artists
            </div>
            <div class="w-full items-center justify-center flex text-sm">... Search you Favourite Artists</div>
        </div>
        <div class="bg-gray-400 flex p-2 rounded">
            <div class="text-gray-900"> <i class="fa fa-search" aria-hidden="true"></i></div>
            <input type="text" v-model="artistToSearch"
                class="font-bold ml-2 w-full bg-gray-400 text-gray-900 outline-none" @keyup="handleArtistSearch">
        </div>
        <div v-if="isLoadingArtists" class="bg-green-300 text-gray-900 font-bold p-2 text-xs mt-2 rounded">
            Getting data ...
        </div>
        <div class="flex flex-wrap">
            <div v-for="artist in  artists " :key="artist.id" class="w-1/4 relative m-2 cursor-pointer">
                <div v-if="artist" class="rounded">
                    <div class="flex" @click="openModal(artist.mbid)">
                        <div class="relative flex items-center justify-center">
                            <img class="rounded h-full" :src="artist.image[2]['#text']" alt="">
                            <div class="absolute h-full w-full opacity-35 bg-gray-900 hover:bg-green-500"></div>
                            <div
                                class="absolute max-h-1/3 w-full bottom-0 text-gray-800 text-xs font-medium shadow bg-white px-2 py-1 rounded-b hover:text-green-600">
                                <div class="whitespace-nowrap overflow-hidden text-sm overflow-ellipsis">{{ artist.name }}</div>
                                <div class="whitespace-nowrap overflow-hidden font-bold text-gray-600 overflow-ellipsis"> <i class="fa-solid fa-play"></i> {{ formatListeners(artist.listeners) }}</div>
                            </div>
                            <div
                                class="absolute top-0 right-0 mr-2 mt-2 text-gray-600 hover:text-green-700 rounded-full font-normal text-2xl cursor-pointer">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <information-modal @componentClosed="closeModal" v-if="openModalOnView" :showModal="showModal" :artistMbid="mbid" />
</template>

<script>
import InformationModal from '../InformationModal.vue';

export default {
    components: { InformationModal },
    data() {
        return {
            artists: [],
            artistToSearch: '',
            cancelToken: null,
            mbid: '',
            openModalOnView: false,
            showModal: true,
            isLoadingArtists: false
        };
    },
    methods: {
        handleArtistSearch() {
            this.artists = [];
            
            this.isLoadingArtists = true;

            if (this.cancelToken) {
                this.cancelToken.cancel();
            }

            this.cancelToken = axios.CancelToken.source();

            axios.get('/api/artists', {
                params: {
                    artist: this.artistToSearch
                },
                cancelToken: this.cancelToken.token
            }).then(response => {
                this.artists = [];
                this.artists = response.data.results.artistmatches.artist.filter(artist => artist.mbid);
                this.isLoadingArtists = false;
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
        this.isLoadingArtists = true;
        axios.get('/api/artists').then(response => {
            this.artists = [];
            this.artists = response.data.results.artistmatches.artist.filter(artist => artist.mbid);
            this.isLoadingArtists = false;
        });
    }
};
</script>