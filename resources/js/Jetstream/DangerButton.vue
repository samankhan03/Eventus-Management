//Delete button
<template>
    <button
        :type="type"
        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-black focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-800 transition ease-in-out duration-150"
    >
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
