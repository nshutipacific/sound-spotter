<template>
    <div class="bg-gray-900 m-2 rounded p-2 flex flex-wrap w-full items-center justify-center">
        <div class="w-full py-4">
            <div class="w-full items-center justify-center flex text-white text-2xl font-black">Sound Spotter Album
            </div>
            <div class="w-full items-center justify-center flex text-sm">... You are viewing an Individual Album</div>
            <div class="w-full items-center justify-center flex text-sm">
                <a href="/albums"
                    class="items-center justify-center flex text-sm bg-green-300 mt-3 px-3 py-1 text-gray-900 text-xs font-bold cursor-pointer rounded-lg">
                    ..back to Albums </a>
            </div>
        </div>
        <div v-if="isLoadingAlbums" class="bg-green-300 text-gray-900 font-bold p-2 text-xs mt-2 rounded">
            Getting data ...
        </div>
        <div class="w-3/4 text-xs">
            <form action="" class="">
                <div class="flex flex-wrap gap-2 mb-4">
                    <label v-if="isEditing" for="name" class="text-white">Album Name</label>
                    <input v-model="albumToView.name" :readonly="!isEditing" type="text" name="name" id="name"
                        class="w-full bg-gray-800 text-white p-2 rounded">
                </div>

                <div class="flex flex-wrap gap-2 mb-4">
                    <label v-if="isEditing" for="artist" class="text-white">Artist</label>
                    <input v-model="albumToView.artist" :readonly="!isEditing" type="text" name="artist" id="artist"
                        class="w-full bg-gray-800 text-white p-2 rounded">
                </div>

                <div class="flex flex-wrap gap-2 mb-4">
                    <label v-if="isEditing" for="image" class="text-white">Image URL</label>
                    <input v-if="isEditing" v-model="album.image" type="text" name="image" id="image"
                        class="w-full bg-gray-800 text-white p-2 rounded">
                    <img v-else :src="albumToView.image" alt="" class="w-1/4 rounded">
                </div>
            </form>
        </div>
        <div class="w-3/4">
            <div v-if="isEditing" class="flex gap-2 text-xs font-bold">
                <button @click="saveAlbum" class="bg-green-300 rounded px-4 py-2 text-gray-900">Save Album</button>
                <button @click="editAlbum" class="bg-red-300 rounded px-4 py-2 text-gray-900">Cancel</button>
            </div>
            <div v-else class="flex gap-2 text-xs font-bold">
                <button @click="editAlbum" class="bg-gray-300 rounded px-4 py-2 text-gray-900">Edit Album</button>
                <button @click="viewAlbum" class="bg-green-300 rounded px-4 py-2 text-gray-900"> View Album
                    (Last.fm)</button>
                <button @click="deleteAlbum" class="bg-red-300 rounded px-4 py-2 text-gray-900"> Delete Album</button>
            </div>
        </div>
    </div>
    <album-modal @componentClosed="closeModal" v-if="openModalOnView" :showModal="showModal"
        :artistName="albumToView.artist" :albumName="albumToView.name" :showModalButtons="false" />
</template>
<script>
export default {
    props: {
        album: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isEditing: false,
            isLoadingAlbums: false,
            albumToView: this.album,
            openModalOnView: false,
            showModal: true,
        }
    },
    methods: {
        editAlbum() {
            this.isEditing = !this.isEditing;
        },
        saveAlbum() {
            this.isEditing = !this.isEditing;
        },
        closeModal() {
            this.openModalOnView = false;
        },
        viewAlbum() {
            this.openModalOnView = true;
        },
        deleteAlbum() {
            if (window.confirm('Are you sure you want to delete ' + this.albumToView.name + '?')) {
                axios.delete('/albums/' + this.albumToView.id)
                    .then(response => {
                        window.location.href = '/albums/?message=' + response.data.message;
                    })
                    .catch(error => {
                        window.location.href = '/albums/?message=' + error.response.data.message;
                    })
            }
        }
    },
    mounted() {
    }
}
</script>