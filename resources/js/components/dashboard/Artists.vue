<template>
    <div class="bg-gray-900 m-2 rounded p-2">
        <div class="w-full py-4">
            <div class="w-full items-center justify-center flex text-white text-2xl font-black">Sound Spotter Artists
            </div>
            <div class="w-full items-center justify-center flex text-sm">... Search you Favourite Artists</div>

        </div>
        <div class="bg-gray-400 flex p-2 rounded">
            <div class="text-gray-900"> <i class="fa fa-search" aria-hidden="true"></i></div>
            <input type="text" v-model="artistToSearch" class="font-bold ml-2 w-full bg-gray-400 text-gray-900 outline-none"
                @keyup="handleArtistSearch">

        </div>
        <div class="flex flex-wrap">
            <div v-for="artist in artists" :key="artist.id" class="w-1/4 p-2">
                <div class="bg-gray-800 rounded p-2">
                    <div class="flex">
                        <div class="w-1/4">
                            <img :src="artist.image" alt="" class="rounded-full h-16">
                        </div>
                        <div class="w-3/4">
                            <div class="text-white font-bold">{{ artist.name }}</div>
                            <div class="text-gray-400 text-xs">{{ artist.listeners }}</div>
                            <div>
                                <img :src="artist.image[2]['#text']" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            artists: [],
            artistToSearch: ''
        }
    },
    methods: {
        handleArtistSearch() {
            this.artists = []
            
            axios.get('/api/artists', {
                params: {
                    artist: this.artistToSearch,
                }
            }).then(response => {
                this.artists = response.data.results.artistmatches.artist
            })
        }
    },

    mounted() {
        axios.get('/api/artists')
            .then(response => {
                console.log(response)
                this.artists = response.data.results.artistmatches.artist
            })
    },
}
</script>