<template>
    <div class="bg-gray-900 m-2 rounded p-2 w-full flex-wrap items-center justify-center">
        <div class="flex w-full p-4 text-xl font-black text-white">
            Stats..
        </div>
        <div class="p-4 text-gray-200 font-bold">
            You have saved the below on your account..
        </div>
        <div class="flex-wrap sm:flex p-4 gap-4 bg-gray-700 rounded">
            <div class="shadow bg-gray-100 rounded-lg text-gray-800 p-4 items-center justify-center">
                <div class="text-6xl font-black"> {{ stats.total_artists}} </div>
                <div class="font-black text-gray-500"> Artist(s)</div>
            </div>
            <div class="shadow bg-gray-100 rounded-lg text-gray-800 p-4 items-center justify-center">
                <div class="text-6xl font-black"> {{ stats.total_albums }}</div>
                <div class="font-black text-gray-500"> Album(s)</div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            stats: {}
        }
    },
    mounted() {
        axios.get('/stats')
            .then(response => {
                this.stats = response.data;
            })
    },
}
</script>