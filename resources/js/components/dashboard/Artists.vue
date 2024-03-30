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
        <div class="flex flex-wrap">
            <div v-for="artist in  artists " :key="artist.id" class="w-1/4 relative m-2">
                <div v-if="artists.length > 0" class="rounded">
                    <div class="flex" @click="openModal(artist.mbid)">
                        <div class="relative flex items-center justify-center">
                            <img class="rounded h-full" :src="artist.image[2]['#text']" alt="">
                            <div class="absolute h-full w-full opacity-35 bg-gray-900"></div>
                            <div
                                class="absolute max-h-1/3 w-full bottom-0 text-gray-800 text-xs font-bold shadow bg-white px-2 py-1 rounded-b">
                                <div class="whitespace-nowrap overflow-hidden overflow-ellipsis">{{ artist.name }}</div>
                                <div class="whitespace-nowrap overflow-hidden overflow-ellipsis"><i
                                        class="fa-solid fa-eye"></i> {{ formatListeners(artist.listeners) }}</div>
                            </div>
                            <div
                                class="absolute top-0 right-0 mr-2 mt-2 text-red-700 bg-white px-1 rounded-full shadow cursor-pointer">
                                <i class="fa-solid fa-heart-circle-plus"></i>
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
        };
    },
    methods: {
        handleArtistSearch() {
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
                this.artists = response.data.results.artistmatches.artist;
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
        axios.get('/api/artists').then(response => {
            this.artists = response.data.results.artistmatches.artist;
            console.log(this.artists)
        });
    }
};
</script>