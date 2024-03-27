<template>

  
    <p>Welcome, {{ user.name }}!</p>
    <p>Your ID is: {{ user.id }}</p>

    <a href="/logout" class="mt-2 px-4 py-2 bg-red-700 rounded-lg"> Log out</a>

    
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