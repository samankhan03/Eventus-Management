<template>
    <div class="flex items-center">
        <span class="text-black">{{ item.disliked }}</span>
        <form @submit.prevent="method">
            <button type="submit" class="focus:outline-none">
                <icon name="thumbs-down" class="w-3 h-3 ml-1 fill-current hover:text-green-600 text-black"></icon>
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['item', 'method']
    }
</script>
