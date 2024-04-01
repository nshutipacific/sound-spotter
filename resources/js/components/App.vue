<template>
    <!--Contents-->
    <div class="bg-gray-900 rounded-r-lg">
        <!--Search bar and login button-->
        <div class="flex justify-between p-6">
            <div>
                <div class="text-gray-200 font-bold">Welcome to SoundSpotter</div>
                <div class="text-xs">
                    <p>
                        Sound spotter is implemented using Laravel and Vue.js
                    </p>
                    <p>
                        It uses the Last.fm API to fetch the latest albums
                    </p>
                    <p>
                        Click on the Google button to login
                    </p>
                    <p>
                        Once logged in, you can search for albums and save them to your account
                    </p>
                </div>
            </div>
            <div>
                <google-sign-in-button />
            </div>
        </div>
        <!-- Featured albums-->
        <div class="p-6">
            <!--title-->
            <div class="my-4">
                <p class="text-xl font-bold text-gray-300">Featured Albums</p>
            </div>
            <!--Albums-->
            <div class=" flex gap-4 overflow-x-auto pb-4">
                <div v-if="!albums || albums.length == 0"
                    class="min-w-32 text-xs flex-wrap items-center justify-center">
                    <div>
                        <div class="h-32 rounded-md bg-gray-600 p-4"> No Albums Found<br /> at the Moment</div>
                    </div>
                    <div class="mt-2 text-gray-300 font-bold"> Please refresh </div>
                    <div>Check Connection </div>
                </div>
                <div v-for="(album, index) in albums" :key="index"
                    class="min-w-32 text-xs  flex-wrap items-center justify-center">
                    <div>
                        <img class="h-32 rounded-md" :src="album.image[2]['#text']" :alt="album.name">
                    </div>
                    <div class="mt-2 text-gray-300 font-bold whitespace-nowrap overflow-hidden overflow-ellipsis">
                        {{ album.name }}</div>
                    <div>{{ album.artist }}</div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>

export default {
    name: 'App',
    data() {
        return {
            albums: []
        }
    },
    mounted() {
        axios.get('/api/albums')
            .then(response => {
                this.albums = response.data.results.albummatches.album
            })
    }
}
</script>