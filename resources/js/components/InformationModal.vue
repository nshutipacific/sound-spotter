<template>
    <div v-if="showPopup" class="absolute w-full h-full z-40 opacity-50 inset-0 bg-black"></div>
    <div v-if="showPopup"
        class="absolute w-3/5 ml-4 top-0 mt-64 z-50 bg-white shadow-2xl border-1 rounded-md p-4 flex items-center justify-center">
        <div class="bg-white w-full rounded-md text-sm text-gray-900">
            <div v-if="artistDoNotExist" class="bg-red-300 p-2 rounded">
                Artist does not have mbid, please try another artist.
            </div>
            <div v-if="isLoading" class="bg-green-300 p-2 rounded">
                Loading information ...
            </div>
            <div v-if="isLoading == false">
                <div class="flex items-center">
                    <img v-if="artist.image" :src="artist.image" class="w-20 h-20 rounded-full" alt="artist image">
                    <div class="ml-4">
                        <h1 class="text-lg font-bold">{{ artist.name }}</h1>
                        <p class="text-sm">{{ artist.bio }}</p>

                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="mt-4">
                        <h2 class="text-lg font-bold">Similar Artists</h2>
                        <ul>
                            <li v-for="similarArtist in artist.similarArtist" :key="similarArtist.name">
                                {{ similarArtist.name }}
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <h2 class="text-lg font-bold">Top Tracks</h2>
                        <ul>
                            <li v-for="topTrack in artist.topTracks" :key="topTrack.name">
                                {{ topTrack.name }}
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        <button class="bg-red-500 text-white px-2" @click="onClose">X</button>
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
                name: "",
                image: '',
                bio: '',
                similarArtist: [],
                topAlbums: [],
                topTracks: [],
            },
            artistDoNotExist: false,
            isLoading: false,
        };
    },
    methods: {
        onClose() {
            this.showPopup = false;
            this.$emit('componentClosed');
        },
        fillInArtistInfo(response) {
            console.log(response);
            this.artist.name = response.data.artistInfo.artist.name;
            this.artist.image = response.data.artistInfo.artist.image[2]['#text'];
            this.artist.bio = this.removeLinkFromString(response.data.artistInfo.artist.bio.summary);

            this.artist.similarArtist = response.data.artistSimilarArtsists.similarartists.artist;

            this.artist.topAlbums = response.data.artistTopAlbums.topalbums.album;
            this.artist.topTracks = response.data.artistTopTracks.toptracks.track;

            console.log(this.artist)
        },
        removeLinkFromString(str) {
            var regex = /<a\s+(?:[^>]*?\s+)?href="([^"]*)"[^>]*>(.*?)<\/a>/g;
            return str.replace(regex, '');
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