<template>
  <div v-if="canLogin" class="welcomepage font-sans">
      <img :src="'/storage/images/logo.png'" alt="logo" class="logo">
      <inertia-link href="#" v-if="$page.props.user" class="text-lg text-gray-700 underline">
          Dashboard
      </inertia-link>
      <template v-else>
          <center>
              <div class="title-box">
                <h1 class="welcome-title">Eventus</h1>
                  <span class="divider"></span>
                  <br><br>
                  <div class="button-group">
                      <inertia-link :href="route('login')" class="btn1">Login</inertia-link>
                      <inertia-link :href="route('register')" v-if="canRegister" class="btn1">Register</inertia-link>
                  </div>
              </div>
          </center>
      </template>
      <br><br>
      <center><p class="activemembers">{{ users }} active members</p></center>
      <br><br><br><br>
      <footer class="footer">
          <p>&copy; {{ new Date().getFullYear() }} Eventus. All Rights Reserved.</p>
      </footer>
  </div>
</template>


<script>
export default {
    props: {
        users: Number,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    computed: {
        currentYear() {
            return new Date().getFullYear();
        }
    }
}
</script>
<style>
.welcomepage {
    background-image: url('/storage/images/background.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    min-height: 100vh;

  padding-top: 90px;
  box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;    
    flex-direction: column;  /* stack title and buttons vertically inside */
    padding-top: 105px
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
  .btn1 {
    font-size: 350%;
    padding: 16px 35px;
    background-color: darkgray;
    color: black;
    font-weight: bolder;
    border-radius: 14px;
    border: aliceblue;
    border: 1px solid aliceblue;
}


.btn1:hover {
    background-color: #595d61a2;
    color: rgb(0, 0, 0);
    transition: all 0.3s ease;
    transform: scale(1.05);
}


.divider{
  width: 600px;
  height: 5px;
  background-color: black;
  display: inline-block;
  border-radius: 50%;
}
  h1{
    font-size: 500%;
    font-weight: bold;
    color: rgb(18, 17, 17);
}

.welcome-title {
        font-size: 500%;
        font-weight: bold;
        color: black; 
    }


.button-group {
    display: flex;
    justify-content: center;
    gap: 50px; /* space between buttons */
}

.title-box {
    background-color: rgba(167, 156, 156, 0.751); /* White box with slight transparency */
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
    display: inline-block;
    text-align: center;
    margin-top: 20px;
}


  .activemembers {
    font-size: 22px;
    color: white;
    font-weight: bolder;
    margin-bottom: 20px;
}

.footer {
    width: 100%;
    text-align: center;
    font-size: 14px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    background-color: #d0cbcb;
    padding: 5px 0;
}
</style>