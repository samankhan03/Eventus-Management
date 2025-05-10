<template>
    <jet-authentication-card>
        <template #logo>
            <inertia-link :href="route('welcome')">
                <img :src="'storage/images/logo.png'" alt="Logo" class="w-64">
            </inertia-link>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Thank you for signing up. Before you can begin, please verify your email address by clicking the verification link we have sent to you. We can resend the email if needed.      </div>

        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
            We've sent a new verification link to your registered email address.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </jet-button>

                <inertia-link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Logout</inertia-link>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetButton from '@/Jetstream/Button'

    export default {
        components: {
            JetAuthenticationCard,
            JetButton,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form()
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
