<template>
  <img :src="'/storage/images/logo.png'" alt="logo" class="logo">
  <center>
    <div class="loginpage font-sans">
          <center>
              <div class="header-container">                    
                <h1 class="login-title"> Eventus </h1>
                <span class="divider"></span>
              </div>
          </center>
          
          <form @submit.prevent="submit" class="loginform">
              <jet-validation-errors class="mb-4" />
              <h2 class="regis">Login Page</h2>
              <p class="login-subtitle"> Enter your details to log in to your account</p>

              <div>
                <br>
                  <jet-label for="email" value="Email" class="email"/>
                  <jet-input id="email" type="email" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.email" required autofocus />
              </div>

              <div class="mt-4">
                  <jet-label for="password" value="Password" class="password" />
                  <jet-input id="password" type="password" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.password" required autocomplete="current-password" />
              </div>

              <div class="block mt-4">
                  <label class="flex items-center remember-me">
                      <jet-checkbox name="remember" v-model="form.remember" />
                      <span class="ml-2">Remember me</span>
                  </label>
              </div>

              <div class="mt-4 forgotpassword">
                  <inertia-link v-if="canResetPassword" :href="route('password.request')" class="forgot-link">
                      Forgot Password?
                  </inertia-link>
              </div>
            

              <inertia-link :href="route('register')" class="account-link">
                  Not registered yet? REGISTER
              </inertia-link>
              <jet-button class="loginbutton rounded-md" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  LOG IN
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
  import JetCheckbox from '@/Jetstream/Checkbox'
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

      props: {
          canResetPassword: Boolean,
          status: String
      },

      data() {
          return {
              form: this.$inertia.form({
                  email: '',
                  password: '',
                  remember: false
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
              this.form
                  .transform(data => ({
                      ... data,
                      remember: this.form.remember ? 'on' : ''
                  }))
                  .post(this.route('login'), {
                      onFinish: () => this.form.reset('password'),
                  })
          }
      }
  }
</script>

<style>
.loginpage {
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

.header-container{ 
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px; 
}

.login-subtitle {
  color: #000000;
  font-weight: bold;
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

.login-title {
  font-size: 420%; 
  font-weight: bold;
  color: rgb(0, 0, 0); 
}

.loginform {
  background-color: rgba(178, 178, 178, 0.9);
  width: 29%;
  box-sizing: border-box;
  max-height: 700px;
  overflow-y: auto;
  font-size: 15px;
  position: center;
  color: #000000;
  padding: 1rem;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  margin-bottom: 40px;
  border-radius: 10px;
}

.loginbutton {
  font-size: 15px;
  background-color: black;
  color: white;
  float: right;
  padding: 8px 15px;
  cursor: pointer;
  border: none;
  border-radius: 5px;
}

.email,
.password {
  color: #000000;
  float: left;
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
  font-weight: bold;
  background-color: #d0cbcb;
  color: rgb(0, 0, 0);
  padding: 5px 0;
  position: relative;
  margin-top: 10px;

}

.remember-me {
  color: #000000;
  font-size: 14px;
  font-weight: bold;
}

.forgotpassword {
  color: #000000;
  font-weight: bold;
  font-size: 14px;
  text-align: center;}

.forgot-link {
  color: #000000;
  text-decoration: underline;
  font-size: 14px;
}

/* Style for the input field text and background */
.input-field-dark {
  color: white !important;
  background-color: black !important;
  border: 1px solid #333;
}
</style>


