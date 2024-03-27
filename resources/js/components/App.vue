<template>
    <div class="flex w-full p-6">
        <!--Sidebar-->
        <div class="bg-gray-800 w-1/4 rounded-l-lg p-4">
            <!--Logo-->
            <div class="p-1 text-2xl">
                SoundSpotter
            </div>
            <!--Navigation-->
            <div class="mt-8">
                <div class="mt-8">
                    <router-link to="/dashboard"
                        class="p-2 block text-white rounded-md hover:bg-gray-900 cursor-pointer">Home</router-link>
                    <router-link to="/profile"
                        class="p-2 block text-white rounded-md hover:bg-gray-900 cursor-pointer">Genres</router-link>
                    <router-link to="/settings"
                        class="p-2 block text-white rounded-md hover:bg-gray-900 cursor-pointer">Artists</router-link>
                    <router-link to="/settings"
                        class="p-2 block text-white rounded-md hover:bg-gray-900 cursor-pointer">Albums</router-link>
                </div>
                <div class="mt-8 mb-8">
                    <!--Link for favourites Album and favourite artists-->
                    <router-link to="/favourites"
                        class="p-2 block text-white rounded-md hover:bg-gray-900 cursor-pointer">Favourites
                        Artists</router-link>
                    <router-link to="/favourites"
                        class="p-2 block text-white rounded-md hover:bg-gray-900 cursor-pointer">Favourites
                        Albums</router-link>
                </div>
            </div>

        </div>
        <!--Contents-->
        <div class="bg-gray-900 w-3/4  rounded-r-lg">
            <!--Search bar and login button-->
            <div class="flex justify-between p-6">
                <div>
                    <input type="search" class="rounded-lg bg-gray-600 text-xs px-4 py-2 outline-none text-white"
                        placeholder="Search artists, albums">
                </div>
                <div>
                    <a href="auth/google" >
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="">
                    </a>
                </div>
            </div>
            <!-- Featured albums-->
            <div class="p-6">
                <!--title-->
                <div class="my-4">
                    <p class="text-xl font-bold text-gray-300">Featured Albums</p>
                </div>
                <!--Albums-->
                <div class="w-full flex gap-4 overflow-x-auto pb-4">
                    <div v-if="!albums || albums.length == 0" class="min-w-32 text-xs flex-wrap items-center justify-center">
                        <div>
                            <div class="h-32 rounded-md bg-gray-600 p-4"> No Albums Found<br/> at the Moment</div>
                        </div>
                        <div class="mt-2 text-gray-300 font-bold"> Please refresh </div>
                        <div>Check Connection </div>
                    </div>
                    <div v-for="(album, index) in albums" :key="index" class="min-w-32 text-xs  flex-wrap items-center justify-center">
                        <div>
                            <img class="h-32 rounded-md" :src="album.image[2]['#text']" :alt="album.name">
                        </div>
                        <div class="mt-2 text-gray-300 font-bold whitespace-nowrap overflow-hidden overflow-ellipsis"> {{ album.name }}</div>
                        <div>{{ album.artist}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            albums: []
        }
    },
    mounted() {
        axios.get('/api/albums')
            .then(response => {
                this.albums = response.data.results.albummatches.album
                console.log(response.data.results.albummatches.album)
            })
    }
}
</script>