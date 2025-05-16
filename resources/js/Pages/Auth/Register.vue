<template>
    <img :src="'/storage/images/logo.png'" alt="logo" class="logo">
    <center>
        <div class="registerpage font-sans">
            <center>
                <h1 class="register-title"> Eventus </h1>
                <span class="divider"></span>
            </center>
            <br><br>
            <form @submit.prevent="submit" class="registerform">
                <jet-validation-errors class="mb-4" />
                <h2 class="regis">Register Page</h2>
                <p> Enter your details to register a new account</p>
                <div>
                    <br>
                    <jet-label for="name" value="Name" class="name"/>
                    <jet-input id="name" type="text" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.name" required autofocus autocomplete="name" />
                </div>
                <br>
                <div>
                    <jet-label for="username" value="Username" class="username" />
                    <jet-input id="username" type="text" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.username" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <jet-label for="email" value="Email" class="email"/>
                    <jet-input id="email" type="email" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.email" required />
                </div>

                <div class="mt-4">
                    <jet-label for="password" value="Password" class="password"/>
                    <jet-input id="password" type="password" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label for="password_confirmation" value="Confirm Password" class="conpassword"/>
                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label for="gender" value="Gender" class="gender" />
                    <select v-model="form.gender" class="block mt-1 w-full border-gray-300 focus: border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm input-field-dark">
                        <option disabled value="">Please select one</option>
                        <option v-bind:value="'Female'">Female</option>
                        <option v-bind:value="'Male'">Male</option>
                    </select>
                </div>

                <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <jet-label for="terms">
                        <div class="flex items-center">
                            <jet-checkbox name="terms" id="terms" v-model="form.terms" />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-white-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                    </jet-label>
                </div>
                <br>

                <inertia-link :href="route('login')" class="account-link">
                    Already registered? LOG IN
                </inertia-link>
                <jet-button class="registerbutton rounded-md" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    REGISTER
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
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    username: '',
                    gender: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        computed: {
            currentYear() {
                return new Date().getFullYear();
            }

        },
        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
<style>
.registerpage {
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

.account-link {
    color: black;
    float: left;
    height: 6%;
    font-weight: bold;
    text-decoration: underline;
    font-size: 15px;
    padding: 5px; 
    border-radius: 5px; 
    margin-left: 14%;
}

h1 {
    font-size: 420%;
    font-weight: bold;
    color: rgb(0, 0, 0);
}

.register-title {
    font-size: 420%; 
    font-weight: bold;
    color: rgb(0, 0, 0); 
}

.registerform {
    background-color: rgba(178, 178, 178, 0.9); 
    width: 29%;
    box-sizing: border-box;
    max-height: 700px;
    overflow-y: auto;
    font-size: 14px;
    position: center;
    color: #000000;
    padding: 1rem;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    margin-bottom: 40px;
    border-radius: 10px;
}

.registerbutton {
    font-size: 15px;
    background-color: black;
    color: white;
    float: right;
    padding: 8px 15px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
}

.name,
.username,
.email,
.password,
.conpassword,
.gender {
    color: #000000;
    float: left;
    font-weight: bold;
}

p {
    color: #000000;
    font-weight: bold;
}

.regis {
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