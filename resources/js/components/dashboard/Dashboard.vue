<template>
    <div class="flex m-6 bg-gray-800 rounded-lg">
        <div class="w-1/4">
            <div class="m-2 flex-wrap items-center justify-center bg-gray-700 p-4 rounded">
                <div>
                    <img class="rounded-full h-16" :src=user.avatar alt="">
                </div>
                <div class="text-xs mt-2">
                    {{ user.name }}
                </div>
                <div class="mt-2 font-bold text-white">Sound Spotter</div>
            </div>
            <navigation />
        </div>
        <div class="bg-gray-900 m-2 rounded p-2">
            Contents
        </div>
    </div>
</template>

<script>
export default {
    name: 'Dashboard',
    props: {
        user: Object
    },
    mounted() {
        console.log(this.user)
    },
}
</script>

<style scoped>
/* Add any custom styles here */
</style>