<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */

  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';

  const router = useRouter();
  const successMessage = ref('');
  const errorMessage = ref('');
  const logDetails = ref({ username: '', password: '' });

  onMounted(() => {
    checkSession();
  });
  
  // Function to check if a session exists
  const checkSession = () => {
      axios.get('http://localhost:8000/php/checkSession.php') 
        .then((response) => {
          if (response.data.user) {
            // If the session exists, navigate to the 'Home' page
            router.push({ name: 'Home' });
          }
        })
        .catch((error) => {
          // Handle any errors...
          console.error(error);
        });
  }

  const keymonitor = () => { 
        checkLogin();
  }

  const checkLogin = () => {
    const logForm = toFormData(logDetails.value);
    axios.post('http://localhost:8000/php/login.php', logForm)
      .then((response) => {
        if (response.data.error) {
          errorMessage.value = response.data.message
        } else {
          successMessage.value = response.data.message
          logDetails.value = { username: '', password: '' }
          setTimeout(() => {
            router.push({ name: 'Home'});
          }, 1000)
        }
      }
    )
  }

  const toFormData = (obj) => {
    const form_data = new FormData()
    for (const key in obj) {
      form_data.append(key, obj[key])
    }
    return form_data
  }

  const clearMessage = () => {
    errorMessage.value = '';
    successMessage.value = '';
  }

</script>

<template>
	
  <body> 

    <section> 

      <form method="POST" class="signin" @submit.prevent="login"> 

          <div class="content"> 

            <h2>Sign In</h2> 

            <div class="form"> 

              <div class="inputBox"> 
                <input type="text" name="username" v-model="logDetails.username" @keyup.enter="keymonitor()" required> <i>Username</i> 
              </div> 

              <div class="inputBox"> 
                <input type="password" name="password" v-model="logDetails.password" @keyup.enter="keymonitor()" required> <i>Password</i> 
              </div> 

              <div class="inputBox"> 
                <button type="submit" name="login" class="loginSubmit" @click="checkLogin()">Login</button>
              </div> 

              <div class="alert alert-danger text-center" v-if="errorMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
              </div>

              <div class="alert alert-success text-center" v-if="successMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-check"></span> {{ successMessage }}
              </div>

            </div> 

          </div> 

      </form> 

    </section>

  </body>
</template>
<style scoped>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  
}
body 
{
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: #000;
}
section 
{
  position: absolute;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2px;
  flex-wrap: wrap;
  overflow: hidden;
}

section .signin
{
  position: absolute;
  width: 400px;
  background: #222;  
  z-index: 1000;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px;
  border-radius: 4px;
  box-shadow: 0 15px 35px rgba(0,0,0,9);
}
section .signin .content 
{
  position: relative;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 40px;
}
section .signin .content h2 
{
  font-size: 2em;
  color: #4ADE80;
  text-transform: uppercase;
}
section .signin .content .form 
{
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 25px;
}
section .signin .content .form .inputBox
{
  position: relative;
  width: 100%;
}
section .signin .content .form .inputBox input 
{
  position: relative;
  width: 100%;
  background: #333;
  border: none;
  outline: none;
  padding: 25px 10px 7.5px;
  border-radius: 4px;
  color: #fff;
  font-weight: 500;
  font-size: 1em;
}
section .signin .content .form .inputBox i 
{
  position: absolute;
  left: 0;
  padding: 15px 10px;
  font-style: normal;
  color: #aaa;
  transition: 0.5s;
  pointer-events: none;
}
.signin .content .form .inputBox input:focus ~ i,
.signin .content .form .inputBox input:valid ~ i
{
  transform: translateY(-7.5px);
  font-size: 0.8em;
  color: #fff;
}
.signin .content .form .links 
{
  position: relative;
  width: 100%;
  display: flex;
  justify-content: space-between;
}
.signin .content .form .links a 
{
  color: #fff;
  text-decoration: none;
}
.signin .content .form .links a:nth-child(2)
{
  color: #4ADE80;
  font-weight: 600;
}
.signin .content .form .inputBox .loginSubmit
{
  padding: 10px;
  background: #4ADE80;
  color: #000;
  font-weight: 600;
  font-size: 1.35em;
  letter-spacing: 0.05em;
  cursor: pointer;
}

.loginSubmit {
  padding: 10px;
  background: #4ADE80; /* Green background color */
  color: #000;
  font-weight: 600;
  font-size: 1em; /* Adjust font size as needed */
  letter-spacing: 0.05em;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  border: none;
  border-radius: 4px;
  display: inline-block;
  width: 100%;
}

.loginSubmit:active
{
  opacity: 0.6;
}

</style>