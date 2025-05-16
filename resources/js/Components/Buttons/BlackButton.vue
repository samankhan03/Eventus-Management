//Used mostly for the black button in the application
<template>
    <button 
        :type="type" 
        class="inline-flex items-center justify-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-500
 focus:outline-none focus:border-black focus:shadow-outline-black active:bg-gray-900 transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    }
</script>
