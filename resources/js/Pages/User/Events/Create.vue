<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    Add an Event
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    <inertia-link :href="route('events.index')"
                        class="underline hover:text-green-500">Events</inertia-link>
                </span>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">

                            <div class="mb-6">
                                <label for="Title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                                <input type="text" v-model="form.title" name="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" />
                                <div v-if="form.errors.title" class="text-sm text-red-600">
                                    {{ form.errors.title }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="Slug"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Slug</label>
                                <input type="text" v-model="form.slug" name="slug"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" />
                                <div v-if="form.errors.slug" class="text-sm text-red-600">
                                    {{ form.errors.slug }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="Desciption"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                                <textarea type="text" v-model="form.description" name="description" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>

                                <div v-if="form.errors.description" class="text-sm text-red-600">
                                    {{ form.errors.description }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="Image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Featured
                                    Image</label>

                                <input type="file" name="image" @input="form.image = $event.target.files[0]" />

                                <div v-if="form.errors.image" class="text-sm text-red-600">
                                    {{ form.errors.image }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="Date_of_event"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date of
                                    Event</label>
                                <input type="date" v-model="form.date_of_event" name="date_of_event" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                <div v-if="form.errors.date_of_event" class="text-sm text-red-600">
                                    {{ form.errors.date_of_event }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="time_start"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start
                                    Time</label>
                                <input type="time" v-model="form.time_start" name="time_start" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                <div v-if="form.errors.time_start" class="text-sm text-red-600">
                                    {{ form.errors.time_start }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="time_end"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">End
                                    Time</label>
                                <input type="time" v-model="form.time_end" name="time_end" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                <div v-if="form.errors.time_end" class="text-sm text-red-600">
                                    {{ form.errors.time_end }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="venue"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Venue</label>
                                <input type="text" v-model="form.venue" name="venue" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                <div v-if="form.errors.venue" class="text-sm text-red-600">
                                    {{ form.errors.venue }}
                                </div>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-black focus:shadow-outline-black active:bg-gray-900 transition ease-in-out duration-150 text-sm"
                                :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                                Submit
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </pages-layout>
</template>

<script setup>
// import InfiniteScroll from '@/Components/InfiniteScroll'
import PagesLayout from '@/Layouts/PagesLayout'
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    events: {
        type: Object,
        default: () => ({}),
    },
});


const form = useForm({
    title: '',
    slug: '',
    description: '',
    date_of_event: '',
    time_start: '',
    time_end: '',
    venue: '',
    image: ''
});
//submit function is calling upon route for the event store in the event controller
const submit = () => {
    form.post(route("events.store"));
};
</script>