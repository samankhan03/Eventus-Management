<template>
    <img :src="'/storage/images/logo.png'" alt="logo" class="logo">
    <center>
        <div class="resetpassword-page font-sans">
            <center>
                <h1>Eventus</h1>
                <span class="divider"></span>
            </center>
           
            <form @submit.prevent="submit" class="resetpassword-form">
                <jet-validation-errors class="mb-4" />
                <h2 class="resetpassword-title">Reset Password</h2>
                <p>Enter your new password.</p>
                
                <div>
                    <br>
                    <jet-label for="reset-email" value="Email" class="reset-label" />
                    <jet-input id="reset-email" type="email" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.email" required autofocus />
                </div>

                <div class="mt-4">
                    <jet-label for="reset-password" value="Password" class="reset-label" />
                    <jet-input id="reset-password" type="password" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label for="reset-password-confirmation" value="Confirm Password" class="reset-label" />
                    <jet-input id="reset-password-confirmation" type="password" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.password_confirmation" required autocomplete="new-password" />
                </div>
                
                <br>
                <jet-button class="resetpassword-button rounded-md" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </jet-button>
            </form>

            <footer class="footer">
                <p>&copy; {{ new Date().getFullYear() }} Eventus. All Rights Reserved.</p>
            </footer>
        </div>
    </center>
</template>


<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
    components: {
        JetAuthenticationCard,
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors
    },

    props: {
        email: String,
        token: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.update'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>

<style>
.resetpassword-page {
    background-image: url('/storage/images/background.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    padding-top: 100px;
}

.logo {
    width: 85px;
    height: 80px;
    position: absolute;
    top: 10px;
    left: 10px;
    border: 4px solid white;
    border-radius: 50%;
    box-sizing: border-box;
}

.divider {
    width: 600px;
    height: 5px;
    background-color: black;
    display: inline-block;
    border-radius: 50%;
}

h1 {
    font-size: 400%;
    font-weight: bold;
    color: rgb(0, 0, 0);
}

.resetpassword-form {
    background-color: rgba(178, 178, 178, 0.9);
    width: 29%;
    box-sizing: border-box;
    max-height: 700px;
    overflow-y: auto;
    font-size: 15px;
    color: #000000;
    padding: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); 
    margin-bottom: 40px;
    border-radius: 10px;
    font-weight: bold;
}

.resetpassword-button {
    font-size: 15px;
    background-color: black;
    color: white;
    float: right;
    padding: 8px 15px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
}

.reset-label {
    color: #000000;
    float: left;
    font-weight: bold;
}

p {
    color: #000000;
    font-weight: bold;
}

.resetpassword-title {
    color: #000000;
    font-weight: bold;
    text-align: center;
    margin-bottom: 10px;
}

.footer {
    width: 100%;
    text-align: center;
    font-size: 14px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    background-color: #d0cbcb;
    padding: 5px 0;
    position: relative;
    margin-top: 10px;
}

.input-field-dark {
    color: white !important;
    background-color: black !important;
    border: 1px solid #333;
}

</style>
