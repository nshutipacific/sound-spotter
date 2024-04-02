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
            <div v-if="albumDoNotExist" class="bg-red-300 p-2 rounded">
                Album does not have name, please try another album.
            </div>
            <div v-if="isLoading" class="bg-green-300 p-2 rounded">
                {{ isLoadingMessage }}
            </div>
            <div v-if="isLoading == false">
                <div class="flex items-center bg-white shadow-lg p-2">
                    <img v-if="album.image" :src="album.image" class="w-30 h-30 rounded-full" alt="album image">
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-blue-900">{{ album.name }}</h3>
                        <p class="text-xs">{{ album.bio }}</p>

                    </div>
                </div>
                <div class="flex justify-between shadow-lg bg-gray-100">
                    <div class="mt-4 p-2 rounded-lg">
                        <h4 class="font-bold text-blue-900">Release date</h4>
                        <p>{{ album.releaseDate }}</p>

                        <h4 class="mt-4 font-bold text-blue-900">Total Plays</h4>
                        <p>{{ formatListeners(album.playCount) }}</p>
                    </div>
                    <div class="mt-4 p-2 rounded-lg">
                        <h4 class=" font-bold text-blue-900">Tracks on this album</h4>
                        <ul>
                            <li class="text-xs" v-for="track in album.trackList" :key="track.name">
                                {{ track.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-center w-full">
                    <button class="bg-green-500 px-2 py-1 rounded text-white cursor-pointer hover:bg-green-600"
                        @click="saveAlbum">
                        Add to My Albums
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
        artistName: {
            type: String,
            default: '',
        },
        albumName: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            showPopup: true,
            album: {
                name: "",
                artist: "",
                image: "",
                releaseDate: "",
                trackList: [],
                playCount: 0,
                bio: "",
            },
            albumDoNotExist: false,
            isLoading: false,
            isLoadingMessage: 'Loading album information...',
        };
    },
    methods: {
        onClose() {
            this.showPopup = false;
            this.$emit('componentClosed');
        },
        fillInAlbumInfo(response) {
            this.album.name = response.data.album.name;
            this.album.artist = response.data.album.artist;
            this.album.image = response.data.album.image[2]['#text']; 
            this.album.releaseDate = response.data.album.wiki.published;
            this.album.trackList = response.data.album.tracks.track;
            this.album.playCount = response.data.album.playcount;
            this.album.bio = this.removeLinkFromString(response.data.album.wiki.summary);
        },
        saveAlbum() {
            this.isLoadingMessage = 'Saving album...';
            this.isLoading = true;

            axios.post('/albums', {
                name: this.album.name,
                artist: this.album.artist,
                image: this.album.image,
                album: this.album.artist,
            }).then(response => {
                this.isLoadingMessage = response.data.message;

                setTimeout(() => {
                    this.showPopup = false;
                    this.$emit('componentClosed');
                }, 5000);
            }).catch(error => {
                this.isLoadingMessage = error.message;
            });
        },
        removeLinkFromString(str) {
            var regex = /<a\s+(?:[^>]*?\s+)?href="([^"]*)"[^>]*>(.*?)<\/a>/g;
            return str.replace(regex, '');
        },
        formatListeners() {
            return parseInt(this.album.playCount).toLocaleString();
        }
    },
    mounted() {
        if (this.albumName == '' || this.artistName == '') {
            this.albumDoNotExist = true;
        } else {
            this.albumDoNotExist = false;
            this.isLoading = true;

            axios.get('/api/album/info', {
                params: {
                    artist: this.artistName,
                    album: this.albumName
                }
            }).then(response => {
                this.isLoading = false;
                this.fillInAlbumInfo(response);
            })
        }
    }
};
</script>