<template>
    <div class="bg-gray-900 m-2 rounded p-2 flex flex-wrap w-full items-center justify-center">
        <div class="w-full py-4">
            <div class="w-full items-center justify-center flex text-white text-2xl font-black">Sound Spotter Artist
            </div>
            <div class="w-full items-center justify-center flex text-sm">... You are viewing an Individual Artist</div>
            <div class="w-full items-center justify-center flex text-sm">
                <a href="/artists"
                    class="items-center justify-center flex text-sm bg-green-300 mt-3 px-3 py-1 text-gray-900 text-xs font-bold cursor-pointer rounded-lg">
                    ..back to Artists </a>
            </div>
        </div>
        <div class="w-3/4 text-xs">
            <form action="" class="">
                <div class="flex flex-wrap gap-2 mb-4">
                    <label v-if="isEditing" for="name" class="text-white">Artist</label>
                    <input v-model="artistToView.name" :readonly="!isEditing" type="text" name="name" id="name"
                        class="w-full bg-gray-800 text-white p-2 rounded">
                </div>

                <div class="flex flex-wrap gap-2 mb-4">
                    <label v-if="isEditing" for="artist" class="text-white">Listeners</label>
                    <input v-model="artistToView.listeners" :readonly="!isEditing" type="text" name="listeners" id="listeners"
                        class="w-full bg-gray-800 text-white p-2 rounded">
                </div>

                <div class="flex flex-wrap gap-2 mb-4">
                    <label v-if="isEditing" for="image" class="text-white">Image URL</label>
                    <input v-if="isEditing" v-model="artist.image" type="text" name="image" id="image"
                        class="w-full bg-gray-800 text-white p-2 rounded">
                    <img v-else :src="artistToView.image" alt="" class="w-1/4 rounded">
                </div>
            </form>
        </div>
        <div class="w-3/4">
            <div v-if="isEditing" class="flex gap-2 text-xs font-bold">
                <button @click="saveArtist" class="bg-green-300 rounded px-4 py-2 text-gray-900">Save Artist</button>
                <button @click="editArtist" class="bg-red-300 rounded px-4 py-2 text-gray-900">Cancel</button>
            </div>
            <div v-else class="flex gap-2 text-xs font-bold">
                <button @click="editArtist" class="bg-gray-300 rounded px-4 py-2 text-gray-900">Edit Artist</button>
                <button @click="viewArtist" class="bg-green-300 rounded px-4 py-2 text-gray-900"> View Artist
                    (Last.fm)</button>
                <button @click="deleteArtist" class="bg-red-300 rounded px-4 py-2 text-gray-900"> Delete Artist</button>
            </div>
        </div>
    </div>
    <artist-modal @componentClosed="closeModal" v-if="openModalOnView" :showModal="showModal"
        :artistMbid="artistToView.mbid" :showModalButtons="false" />
</template>
<script>
export default {
    props: {
        artist: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isEditing: false,
            isLoadingAlbums: false,
            artistToView: this.artist,
            openModalOnView: false,
            showModal: true,
        }
    },
    methods: {
        editArtist() {
            this.isEditing = !this.isEditing;
        },
        saveArtist() {
            this.isEditing = !this.isEditing;

            axios.patch('artists', this.artistToView)
                .then(response => {
                    window.location.href = '/artists/?message=' + response.data.message;
                })
                .catch(error => {
                    window.location.href = '/artists/?message=' + error.response.data.message;
                })
        },
        closeModal() {
            this.openModalOnView = false;
        },
        viewArtist() {
            this.openModalOnView = true;
        },
        deleteArtist() {
            if (window.confirm('Are you sure you want to delete ' + this.artistToView.name + '?')) {
                axios.delete('/artists/' + this.artistToView.id)
                    .then(response => {
                        window.location.href = '/artists/?message=' + response.data.message;
                    })
                    .catch(error => {
                        window.location.href = '/artists/?message=' + error.response.data.message;
                    })
            }
        }
    },
}
</script>