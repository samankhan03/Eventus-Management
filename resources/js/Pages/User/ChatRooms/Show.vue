<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col">
                <button @click="leaveRoom"
        class="flex text-white py-2 px-4 border rounded-md bg-gray-800 hover:bg-gray-500 focus:outline-none w-32"
        type="button">
    <icon name="angle-left" class="w-3 h-3 fill-current text-white"></icon>
    <span class="font-semibold text-lg capitalize ml-2">Leave</span>
</button>



                <div class="flex justify-between items-center mt-5">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                        Welcome to: {{ room.name }}
                    </h3>
                    <h4 v-if="activeCount > 0">{{ activeCount }} active users</h4>
                </div>

                <div class="flex space-x-4 mt-5">
                    <div class="flex-shrink-0 rounded-md border border-gray-300 h-128">
                        <chat-actives :users="users"></chat-actives>
                    </div>
                    <div class="flex-1 rounded-md border border-gray-300 flex flex-col h-128">
                        <chat-box :messages="messages" id="container"></chat-box>
                        <chat-input :method="submitMessage" :form="form" :item="room"></chat-input>
                    </div>
                </div>
            </div>
        </template>
    </pages-layout>
</template>

<script>
import ChatActives from '@/Components/Chat/ChatActives'
import ChatBox from '@/Components/Chat/ChatBox'
import ChatInput from '@/Components/Chat/ChatInput'
import PagesLayout from '@/Layouts/PagesLayout'
export default {
    props: ['room', 'messages'],
    components: {
        ChatActives,
        ChatBox,
        ChatInput,
        PagesLayout,
    },
    data() {
        return {
            activeCount: 0,
            users: [],
            form: this.$inertia.form({
                body: this.body,
                room: this.room
            }),
            updateUserForm: this.$inertia.form({
                room: this.room,
                count: 0,
            })
        }
    },
    mounted() {
        this.getActive()
        this.scrollToBottom()
        this.connect()
    },
    methods: {
        // Function to submit a message
        submitMessage() {
            this.form.post(this.route('chat-rooms.store', this.room), {
                preserveScroll: true,
                onSuccess: () => {
                    this.scrollToBottom()
                    this.form.body = null
                }
            })
        },

       
        scrollToBottom() {
            let container = document.querySelector("#container");
            container.scrollTop = container.scrollHeight
        },

        // Fetch active users in the room
        getActive() {
            this.updateUserForm.post(this.route('chat-rooms.update', this.room), {
                preserveScroll: true,
                onSuccess: () => { }
            })
        },

        
        leaveRoom() {
            this.$inertia.post(this.route('chat-rooms.logout', this.room.slug));
        },

        // Set up live WebSocket connection using Echo
        connect() {
            Echo.join(`chat.${this.room.id}`)
                .here((users) => {
                    this.activeCount = users.length
                    this.users = users
                    this.updateUserForm.count = this.activeCount
                    this.getActive()
                })
                .joining((user) => {
                    this.activeCount++
                    this.users.push(user)
                    this.updateUserForm.count = this.activeCount
                    this.getActive()
                })
                .leaving((user) => {
                    this.activeCount--
                    this.users.splice(this.users.indexOf(user), 1)
                    this.updateUserForm.count = this.activeCount
                    this.getActive()
                })
                .listen('NewChatMessageEvent', (e) => {
                    let newMessage = {
                        body: e.message.body,
                        user: e.user
                    }
                    this.messages.push(newMessage)
                    this.scrollToBottom()
                })
        }
    },
    beforeDestroy() {
        if (this.users.length = 1) {
            this.updateUserForm.count = 0
            this.getActive()
        } else {
            this.getActive()
        }
    },
    destroyed() {
        Echo.leave(`chat.${this.room.id}`)
    },
    watch: {
        messages: function () {
            this.$nextTick(function () {
                this.scrollToBottom()
            })
        }
    }
}
</script>
