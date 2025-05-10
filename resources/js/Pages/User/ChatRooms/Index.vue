<template>
    <pages-layout>

        <template #title>
            <div class="flex flex-col">
                <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                    <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                        <inertia-link :href="route('chat-rooms.index')" class="capitalize underline">
                            Study Rooms
                        </inertia-link>
                    </h2>
                    <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                        <inertia-link :href="route('chat-rooms.create')" class="underline hover:text-green-500">Create Study Room</inertia-link>
                    </span>
                </div>

                <table class="mt-5">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left pl-3">Room Name:</th>
                            <th>Active Members:</th>
                            <th class="text-right pr-3">Join</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b bg-gray-50 h-10 hover:bg-gray-400 hover:text-blue-800 transition ease-in-out duration-150" v-for="(room, index) in rooms" :key="index">
                            <td class="text-left pl-3 py-3">{{ room.name }}</td>
                            <td class="text-center py-3">{{ room.active }}</td>
                            <td class="text-right pr-3 py-3">
                                <form action="" method="put">
                                    <green-button :href="route('chat-rooms.update', room.slug)" class="text-xs">Join</green-button> 
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>

    </pages-layout>
</template>

<script>
    import GreenButton from '@/Components/Buttons/GreenButton'
    import PagesLayout from '@/Layouts/PagesLayout'
    import { useForm } from "@inertiajs/inertia-vue3";

    export default {
        props: ['rooms'],
        components: {
            GreenButton,
            PagesLayout,
        }
    }
        

</script>
