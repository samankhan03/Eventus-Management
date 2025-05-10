<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    Event
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    <inertia-link :href="route('events.index')"
                        class="underline hover:text-green-500">Events</inertia-link>
                </span>
            </div>
        </template>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">

            <img :src="showImage() + props.event.image" alt="Article Image"
                class="w-full h-64 object-cover object-center">

            <div class="px-4 py-5 sm:px-6">

                <div class="flex flex-col items-left sm:flex-row sm:justify-between mb-2">
                    <div class="mr-2 flex items-end font-semibold text-lg text-red-500 leading-tight">{{
                        props.event.date_of_event }}</div>
                    AT
                    <span class="ml-2 flex items-end font-semibold text-lg text-red-500 leading-tight">
                        {{ props.event.time_start }}
                    </span>
                    -
                    <span class="ml-2 flex items-end font-semibold text-lg text-red-500 leading-tight">
                        {{ props.event.time_end }}
                    </span>
                </div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ props.event.title }}</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ props.event.venue }}</p>
            </div>

            <div class="warpper">
                <input class="radio" id="one" name="group" type="radio" checked>
                <input class="radio" id="two" name="group" type="radio">

                <div class="tabs">
                    <label class="tab" id="one-tab" for="one">About</label>
                    <label class="tab" id="two-tab" for="two">Discussion</label>
                </div>

                <div class="panels">
                    <div class="panel" id="one-panel">
                        <div class="panel-title">Details</div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                            <dl class="sm:divide-y sm:divide-gray-200">

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                                    <dt class="text-sm font-medium text-gray-500">
                                        {{ eventAttendees }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        People Attending
                                    </dd>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Title
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ props.event.title }}
                                    </dd>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Slug
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ props.event.slug }}
                                    </dd>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Description
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ props.event.description }}
                                    </dd>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Venue
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ props.event.venue }}
                                    </dd>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                                    <form @submit.prevent="submit">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-black focus:shadow-outline-black active:bg-gray-900 transition ease-in-out duration-150 text-xs whitespace-nowrap"
                                            :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                                            Reserve tickets
                                        </button>

                                    </form>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div class="panel" id="two-panel">
                        <div class="panel-title">{{ props.event.venue }}</div>
                        <img :src="showImage() + props.event.image" alt="Article Image"
                            class="w-full h-64 object-cover object-center">
                        <div class="mr-2 flex items-end font-semibold text-lg text-red-500 leading-tight">{{
                            props.event.date_of_event }} At {{ props.event.time_start }}</div>
                        <div class="panel-title">{{ props.event.title }}</div>
                        <p>{{ props.event.venue }}</p>
                        <p>{{ eventAttendees }} people interested</p>

                        <div class="flex flex-col items-left sm:flex-row sm:justify-between mt-2 mb-2">
                            <div class="mr-2 flex items-end font-semibold text-base text-blue-500 leading-tight">
                                <Like :item="event" :method="submitLike"></Like> Like
                            </div>
                        </div>

                        <post-form :method="submitComment" :form="commentForm" :text="'Comment'"></post-form>

                        <EventComments></EventComments>
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

import Like from '@/Components/PostComment/Likes/Like'
import PostForm from '@/Components/PostComment/PostForm'
import EventComments from './EventComments'

const props = defineProps({
    event: {
        type: Object,
        default: () => ({}),
    },
    eventAttendees: {
        type: Number,
        required: true,
    }
});

const post = props.event.id


const form = useForm({
    title: props.event.title,
    slug: props.event.slug,
    description: props.event.description,
    date_of_event: props.event.date_of_event,
    time_start: props.event.time_start,
    time_end: props.event.time_end,
    venue: props.event.venue,
    image: props.event.image,
    id: props.event.id
});

const showImage = () => {
    return "/storage/";
};

const submit = () => {
    form.post(route("events.attendees", props.event.id));
};

const commentForm = useForm({
    body: '',
    user_id: props.event.user_id,
});

const likeForm = useForm({
    userEvent: props.event
});

const submitComment = () => {
    commentForm.post(route('eventcomments.store', props.event), {
        preserveScroll: true,
        onSuccess: () => {
            Toast.fire({
                icon: 'success',
                title: 'Your comment has successfully been published!'
            })
            commentForm.body = null
        }
    })
}

const submitLike = () => {
    likeForm.post(route('event-like.store', props.event), {

        preserveScroll: true,
        onSuccess: () => {
            Toast.fire({
                icon: 'success',
                title: 'You liked the event successfully!'
            })
        }
    })
}


</script>

<style>
.warpper {
    display: flex;
    flex-direction: column;
    /* align-items: left; */
}

.tab {
    cursor: pointer;
    padding: 10px 20px;
    margin: 0px 2px;
    background: #000000;
    display: inline-block;
    color: #fff;
    border-radius: 3px 3px 0px 0px;
    box-shadow: 0 0.5rem 0.8rem #00000080;
}

.panels {
    background: #fffffff6;
    box-shadow: 0 2rem 2rem #00000080;
    margin: 7px 42px;
    min-height: 200px;
    width: 100%;
    max-width: 600px;
    border-radius: 3px;
    overflow: hidden;
    padding: 20px;
}

.panel {
    display: none;
    animation: fadein .8s;
}

@keyframes fadein {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.panel-title {
    font-size: 1.5em;
    font-weight: bold
}

.radio {
    display: none;
}

#one:checked~.panels #one-panel,
#two:checked~.panels #two-panel,
#three:checked~.panels #three-panel {
    display: block
}

#one:checked~.tabs #one-tab,
#two:checked~.tabs #two-tab,
#three:checked~.tabs #three-tab {
    background: #fffffff6;
    color: #000000;
    border-top: 3px solid #000000;
}
</style>