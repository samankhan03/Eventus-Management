<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <inertia-link :href="route('events.index')" class="capitalize underline">
                        My Tickets
                    </inertia-link>
                </h2>
            </div>
        </template>

        <div class="flex flex-col">
            <table class="mt-5">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left pl-3">Ticket Id:</th>
                            <th>Event Title:</th>
                            <!-- <th class="text-right pr-3">Join</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b bg-gray-50 h-10 hover:bg-gray-400 hover:text-blue-600 transition ease-in-out duration-150" v-for="(eventAttendee, index) in eventAttendees" :key="index">
                            <td class="text-left pl-3 py-3">{{ eventAttendee.id }}</td>
                            <td class="text-center py-3">{{ eventAttendee.title }}</td>
                            <!-- <td class="text-right pr-3 py-3">
                                <green-button :href="route('chat-rooms.show', room.slug)" class="text-xs">Join</green-button>
                            </td> -->
                        </tr>
                    </tbody>
            </table>
        </div>

    </pages-layout>
</template>


<script>
    import InfiniteScroll from '@/Components/InfiniteScroll'
    import PagesLayout from '@/Layouts/PagesLayout'
    export default {
        props: ['eventAttendees', 'users'],
        components: {
            InfiniteScroll,
            PagesLayout,
        },
    }
</script>