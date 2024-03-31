<template>
    <div v-if="showPopup" class="absolute w-full h-full z-40 opacity-50 inset-0 bg-black"></div>
    <div v-if="showPopup"
        class="absolute w-3/5 ml-4 top-0 mt-64 z-50 bg-white shadow-2xl border-1 rounded-md p-4 flex items-center justify-center">
        <div class="bg-white w-full rounded-md text-sm text-gray-900">
            <div class="flex w-full justify-end">
                <button class="text-2xl text-red-500 cursor-pointer hover:text-red-700" @click="onClose">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </div>
            <div v-if="artistDoNotExist" class="bg-red-300 p-2 rounded">
                Artist does not have mbid, please try another artist.
            </div>
            <div v-if="isLoading" class="bg-green-300 p-2 rounded">
                {{ isLoadingMessage }}
            </div>
            <div v-if="isLoading == false">
                <div class="flex items-center bg-white shadow-lg p-2">
                    <img v-if="artist.image" :src="artist.image" class="w-30 h-30 rounded-full" alt="artist image">
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-blue-900">{{ artist.name }}</h3>
                        <p class="text-xs">{{ artist.bio }}</p>

                    </div>
                </div>
                <div class="flex justify-between shadow-lg bg-gray-100">
                    <div class="mt-4 p-2 rounded-lg">
                        <h4 class=" font-bold text-blue-900">Similar Artists</h4>
                        <ul>
                            <li v-for="similarArtist in artist.similarArtist" :key="similarArtist.name">
                                {{ similarArtist.name }}
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4 p-2 rounded-lg">
                        <h4 class=" font-bold text-blue-900">Top Tracks</h4>
                        <ul>
                            <li v-for="topTrack in artist.topTracks" :key="topTrack.name">
                                {{ topTrack.name }}
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4 p-2 rounded-lg">
                        <h4 class=" font-bold text-blue-900">Top Albums</h4>
                        <ul>
                            <li v-for="topAlbum in artist.topAlbums" :key="topAlbum.name">
                                {{ topAlbum.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-center w-full">
                    <button class="bg-green-500 px-2 py-1 rounded text-white cursor-pointer hover:bg-green-600" @click="saveArtist">
                        Add to My Artists
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    emits: ['componentClosed'],
    name: "InformationModal",
    props: {
        showModal: {
            type: Boolean,
            default: false,
        },
        artistMbid: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            showPopup: true,
            artist: {
                mbid: '',
                name: "",
                listeners: 0,
                image: '',
                bio: '',
                similarArtist: [],
                topAlbums: [],
                topTracks: [],
            },
            artistDoNotExist: false,
            isLoading: false,
            isLoadingMessage: 'Loading artist information...',
        };
    },
    methods: {
        onClose() {
            this.showPopup = false;
            this.$emit('componentClosed');
        },
        fillInArtistInfo(response) {
            this.artist.mbid = response.data.artistInfo.artist.mbid;
            this.artist.name = response.data.artistInfo.artist.name;
            this.artist.listeners = response.data.artistInfo.artist.stats.listeners;
            this.artist.image = response.data.artistInfo.artist.image[2]['#text'];
            this.artist.bio = this.removeLinkFromString(response.data.artistInfo.artist.bio.summary);

            this.artist.similarArtist = response.data.artistSimilarArtsists.similarartists.artist;

            this.artist.topAlbums = response.data.artistTopAlbums.topalbums.album;
            this.artist.topTracks = response.data.artistTopTracks.toptracks.track;
        },
        removeLinkFromString(str) {
            var regex = /<a\s+(?:[^>]*?\s+)?href="([^"]*)"[^>]*>(.*?)<\/a>/g;
            return str.replace(regex, '');
        },
        saveArtist() {
            this.isLoadingMessage = 'Saving artist...';
            this.isLoading = true;

            axios.post('/artists', {
                mbid: this.artist.mbid,
                name: this.artist.name,
                image: this.artist.image,
                listeners: this.artist.listeners,
            }).then(response => {
                this.isLoadingMessage = response.data.message;
                
                setTimeout(() => {                    
                    this.showPopup = false;
                    this.$emit('componentClosed');
                }, 5000);
            }).catch(error => {
                    this.isLoadingMessage = error.message;
            });
        }

    },
    mounted() {
        if (this.artistMbid == '') {
            this.artistDoNotExist = true;
        } else {
            this.artistDoNotExist = false;
            this.isLoading = true;

            axios.get('/api/artist/info', {
                params: {
                    mbid: this.artistMbid,
                }
            }).then(response => {
                this.isLoading = false;
                this.fillInArtistInfo(response);
            })
        }
    }
};
</script>