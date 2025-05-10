<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <inertia-link :href="route('events.index')" class="capitalize underline">
                        Events
                    </inertia-link>
                </h2>
            </div>
        </template>

        <div class="w-full lg:flex m-2" v-for="(event, index) in events" :key="index">
            <div
                class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                <img :src="showImage() + event.image" class="object-cover h-50 w-full" />
            </div>

            <div
                class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal text-black w-full">
                <div class="mb-2">
                    <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                        <div class="mr-2 flex items-end font-semibold text-lg text-red-500 leading-tight">
                            <span class="text-red-500">{{ event.date_of_event }}</span>
                        </div>
                        AT
                        <span class="time flex items-end font-semibold text-lg leading-tight text-red-500">
                            {{ event.time_start }}
                        </span>
                    </div>

                    <div class="text-gray-900 font-bold text-xl mb-2">{{ event.title }}</div>
                    <p class="text-gray-700 text-base">{{ event.description }}</p>
                </div>


                <div class="flex items-center space-x-2">
                    <template v-if="$page.props.user.id == event.user_id">
                        <inertia-link :href="route('events.edit', event.id)" as="button" type="button">
                            <jet-button>Edit</jet-button>
                        </inertia-link>
                    </template>

                    <inertia-link :href="route('events.show', event.id)" as="button" type="button">
                        <jet-button>View</jet-button>
                    </inertia-link>

                    <template v-if="$page.props.user.id == event.user_id">
                        <jet-danger-button @click="deleteEvent(event)">
                            Delete
                        </jet-danger-button>
                    </template>
                </div>
            </div>
        </div>
    </pages-layout>
</template>


<script>
import InfiniteScroll from '@/Components/InfiniteScroll';
import PagesLayout from '@/Layouts/PagesLayout';
import JetButton from '@/Jetstream/Button';
import JetDangerButton from '@/Jetstream/DangerButton';

export default {
    props: ['events', 'users'],
    components: {
        InfiniteScroll,
        PagesLayout,
        JetButton,
        JetDangerButton, 
    },
    methods: {
        showImage() {
            return "/storage/";      //showing image of the event
        },
        deleteEvent(event) {
            if (confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
                this.$inertia.delete(route('events.destroy', event), {
                    onSuccess: () => {
                        this.$emit('success', 'Event deleted successfully.'); 
                    },
                    onError: (errors) => {
                        console.error('Error deleting event:', errors);
                        
                    },
                });
            }
        },
    },
};
</script>
