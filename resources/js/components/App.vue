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
                    <a  href="auth/google" class="bg-blue-500 px-4 py-1 rounded-lg text-white font-bold">Login</a>
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
                    <div class="min-w-32 text-xs flex flex-wrap items-center justify-center">
                        <div>
                            <img class="h-32 rounded-md"
                                src="https://i.ibb.co/ZJggfrw/giorgio-trovato-Pdt-Apuz-R-IQ-unsplash.jpg"
                                alt="giorgio-trovato-Pdt-Apuz-R-IQ-unsplash">
                        </div>
                        <div class="mt-2 text-gray-300 font-bold"> Album Name </div>
                        <div> Artist Name </div>
                    </div>
                    <div class="min-w-32 text-xs flex flex-wrap items-center justify-center">
                        <div>
                            <img class="h-32 rounded-md"
                                src="https://i.ibb.co/ZJggfrw/giorgio-trovato-Pdt-Apuz-R-IQ-unsplash.jpg"
                                alt="giorgio-trovato-Pdt-Apuz-R-IQ-unsplash">
                        </div>
                        <div class="mt-2 text-gray-300 font-bold"> Album Name </div>
                        <div> Artist Name </div>
                    </div>
                    <div class="min-w-32 text-xs flex flex-wrap items-center justify-center">
                        <div>
                            <img class="h-32 rounded-md"
                                src="https://i.ibb.co/ZJggfrw/giorgio-trovato-Pdt-Apuz-R-IQ-unsplash.jpg"
                                alt="giorgio-trovato-Pdt-Apuz-R-IQ-unsplash">
                        </div>
                        <div class="mt-2 text-gray-300 font-bold"> Album Name </div>
                        <div> Artist Name </div>
                    </div>
                    <div class="min-w-32 text-xs flex flex-wrap items-center justify-center">
                        <div>
                            <img class="h-32 rounded-md"
                                src="https://i.ibb.co/ZJggfrw/giorgio-trovato-Pdt-Apuz-R-IQ-unsplash.jpg"
                                alt="giorgio-trovato-Pdt-Apuz-R-IQ-unsplash">
                        </div>
                        <div class="mt-2 text-gray-300 font-bold"> Album Name </div>
                        <div> Artist Name </div>
                    </div>
                    <div class="min-w-32 text-xs flex flex-wrap items-center justify-center">
                        <div>
                            <img class="h-32 rounded-md"
                                src="https://i.ibb.co/ZJggfrw/giorgio-trovato-Pdt-Apuz-R-IQ-unsplash.jpg"
                                alt="giorgio-trovato-Pdt-Apuz-R-IQ-unsplash">
                        </div>
                        <div class="mt-2 text-gray-300 font-bold"> Album Name </div>
                        <div> Artist Name </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
</script>