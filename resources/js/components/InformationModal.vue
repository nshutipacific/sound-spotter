<template>
    <div v-if="showPopup" class="absolute w-full h-full z-40 opacity-50 inset-0 bg-black"></div>
    <div v-if="showPopup"
        class="absolute w-3/5 h-64 ml-4 top-0 mt-64 z-50 bg-white shadow-2xl border-1 rounded-md p-4 flex items-center justify-center">
        <div class="bg-white w-full rounded-md text-sm text-gray-900">
            {{ artistMbid }}

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
        };
    },
    methods: {
        onClose() {
            this.showPopup =false;
            this.$emit('componentClosed');
        },
    },

};
</script>