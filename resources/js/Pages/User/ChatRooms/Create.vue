<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h4 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    Create a Study Room
                </h4>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    <inertia-link :href="route('chat-rooms.index')" class="underline hover:text-green-500">Study Rooms</inertia-link>
                </span>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            
                            <div class="mb-6">
                                <label
                                    for="Title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >Name</label
                                >
                                <input
                                    type="text"
                                    v-model="form.name"
                                    name="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label
                                    for="Slug"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >Slug</label
                                >
                                <input
                                    type="text"
                                    v-model="form.slug"
                                    name="slug"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.slug"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.slug }}
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="text-white bg-black hover:bg-blue-700 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing }"
                            >
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
        name: '', 
        slug: '',  
    });

    const submit = () => {
        form.post(route("new.room"));
    };
</script>