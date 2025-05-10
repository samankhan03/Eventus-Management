<template>
    <div>
        <div v-for="(event, key) in events" :key="key">
            <event-item :post="post"></event-item>
        </div>
    </div>
</template>

<script>
    import PostItem from './PostItem'
    export default {
        props: ['events'],
        components: {
            EventItem,
        }
    }
</script>
