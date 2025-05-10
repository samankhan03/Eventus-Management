<template>
    <form @submit.prevent="method" class="w-full">
        <div>
            <textarea name="post" rows="3" class="border rounded px-2 py-2 w-full" :placeholder="`Post something ${$page.props.user.username} ...`" v-model="form.body"></textarea>
        </div>
        <div class="flex justify-between my-3">
            <div>
                <jet-input-error :message="form.errors.body" class="mt-2" v-if="form.errors.body"></jet-input-error>
            </div>
            <div>
               
                <black-button type="submit" class="text-xs" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <fingerprint-spinner
                        :animation-duration="1500"
                        :size="20"
                        class="text-white"
                        v-if="form.processing"
                    />
                    <span v-else>{{ text }}</span>
                </black-button>
            </div>
        </div>
    </form>
</template>

<script>
    import { FingerprintSpinner } from 'epic-spinners'
    import BlackButton from '@/Components/Buttons/BlackButton'  
    import JetInputError from '@/Jetstream/InputError'

    export default {
        props: ['method', 'form', 'text'],
        components: {
            BlackButton, 
            FingerprintSpinner,
            JetInputError,
        },
    }
</script>
