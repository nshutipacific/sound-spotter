<template>
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
</template>