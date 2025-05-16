<template>
  <div class="resetpass font-sans">
      <img :src="'/storage/images/logo.png'" alt="logo" class="logo">
      <div class="header-container">
        <h1> Eventus </h1>
        <span class="divider"></span><br>
      </div>
     <div class="form-container">
        <div class="forgot-password-form">
            <h2 class="regis">Forgot Password</h2>
            <p>  Simply provide your email, and we'll send you a link to create a new one.</p>
            <br>
            <form @submit.prevent="submit" >
              <jet-validation-errors class="mb-4" />
                    <jet-label for="email" value="Email" class="email" />
                    <jet-input id="email" type="email" class="mt-1 block w-full rounded-md input-field-dark" v-model="form.email" required autofocus />
                    <br><br>
                    <jet-button class="forgot-password-button rounded-md" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">  Email Password Reset Link
                    </jet-button>
            </form>
        </div>
      </div>
      <footer class="footer">
        <p>&copy; {{ new Date().getFullYear() }} Eventus. All Rights Reserved.</p>
      </footer>
  </div>
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
          status: String
      },

      data() {
          return {
              form: this.$inertia.form({
                  email: ''
              })
          }
      },

      methods: {
          submit() {
              this.form.post(this.route('password.email'))
          }
      }
  }
</script>

<style>
.resetpass{
  background-image: url('/storage/images/background.png');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between; /* Push content to top and bottom */
  padding-bottom: 0; 
  }

.header-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 100px;
  margin-bottom: 20px;
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
.divider{
width: 600px;
height: 5px;
background-color: black;
display: inline-block;
  border-radius: 50%;
}
h1{
  font-size: 400%;
  font-weight: bold;
  color: rgb(0, 0, 0);
}

.form-container{
    display: flex;
    justify-content: center;
    align-items: flex-start;
    width: 100%;
}

.forgot-password-form {
  background-color: rgba(178, 178, 178, 0.9);
  width: 29%;
  box-sizing: border-box;
  max-height: 700px;
  overflow-y: auto;
  font-size: 16px;
  color: #000000;
  padding: 1rem;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
}

.forgot-password-button { 
  font-size: 15px;
  background-color: black;
  color: white;
  float: right;
  padding: 8px 15px;
  cursor: pointer;
  border: none;
  border-radius: 5px;
}

.email{
  color: #000000;
  float: left;
  font-weight: bold;
  font-size: 16px;
}


.input-field-dark {
  color: white !important;
  background-color: black !important;
  border: 1px solid #333;
}
p{
  color: #000000;
  font-weight: bold;
}
.regis{
  color: #000000;
  font-weight: bold;
  text-align: center;
  margin-bottom: 10px;
}

.footer {
    width: 100%;
    text-align: center;
    font-size: 14px;
    color: white;
    font-weight: bold;
    background-color: #d0cbcb;
    padding: 5px 0;
    margin-top: auto; 
}
</style>
