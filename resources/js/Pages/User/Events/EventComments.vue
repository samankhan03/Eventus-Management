<template>
    <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
        Comments
    </h2>

    <div class="max-w-sm w-full lg:max-w-full lg:flex m-2" v-for="(comment, index) in comments" :key="index">
        <p>{{ comment.body }}</p>
    </div>
</template>

<script>
    export default {
        props: ['comments']        
    }

</script>