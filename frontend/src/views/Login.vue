<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */

  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';

  // Initialize variables
  const router = useRouter(); //// Create a 'router' object using imported 'useRouter' function
  const successMessage = ref(''); // Reference to success message
  const errorMessage = ref(''); // Reference to error message
  const logDetails = ref({ username: '', password: '' }); // Object to store user input from login form


  // Hook to check the session when the component is mounted
  onMounted(() => {
    checkSession();
  });
  
  // Function to check if a session exists
  const checkSession = () => {
      axios.get('http://localhost:8000/php/checkSession.php') 
        .then((response) => {
          if (response.data.user) {
            // If the session exists, navigate directly to the 'Home' page, so that user doesn't have to login again
            router.push({ name: 'Home' });
          }
        })
        .catch((error) => {
          // Handle any errors...
          console.error(error);
        });
  }

  // Function to check user login
  const checkLogin = () => {
    // Convert login details to FormData using function toFormData()
    const logForm = toFormData(logDetails.value);

    // Send a POST request to the login.php script with the username and password from user input
    axios.post('http://localhost:8000/php/login.php', logForm)
      .then((response) => {
        // Check if the response data indicates an error
        if (response.data.error) {
          // If true, set the error message
          errorMessage.value = response.data.message
        } else {
          // If false, set the success message
          successMessage.value = response.data.message

          // Clear the user input
          logDetails.value = { username: '', password: '' }

          // Navigate to the 'Home' page after a delay (2 seconds)
          setTimeout(() => {
            router.push({ name: 'Home'});
          }, 2000)
        }
      }
    )
  }

  // Convert an object to FormData
  const toFormData = (obj) => {
    // Create a new FormData object
    const form_data = new FormData()

    // Iterate through the object and append its key-value pairs to FormData
    for (const key in obj) {
      form_data.append(key, obj[key])
    }

     // Return the FormData object
    return form_data
  }

  // Function to clear error and success messages
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

              <!-- Username input -->
              <div class="input-box"> 
                <input type="text" name="username" v-model="logDetails.username" required> <i>Username</i> <!-- The v-model directive binds the username input value to the logDetails.username in script -->
              </div> 

               <!-- Password input -->
              <div class="input-box"> 
                <input type="password" name="password" v-model="logDetails.password" required> <i>Password</i> <!-- The v-model directive binds the password input value to the logDetails.password in script --> 
              </div> 

              <!-- Login button -->
              <div class="input-box"> 
                <button type="submit" name="login" class="login-submit" @click="checkLogin()">Login</button> <!-- Run function checkLogin when click on login button -->
              </div> 

              <!-- Error message container -->
              <div class="alert alert-danger text-center" v-if="errorMessage">
                <span class="material-icons">warning</span> {{ errorMessage }} <!-- Show error message when error exists -->
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true" class="material-icons">close</span></button> <!-- Button to close message --> 
              </div>

               <!-- Success message container -->
              <div class="alert alert-success text-center" v-if="successMessage">
                <span class="material-icons">check_circle</span> {{ successMessage }} <!-- Show error message when login succeeds -->
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true" class="material-icons">close</span></button> <!-- Button to close message -->
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
section .signin .content .form .input-box
{
  position: relative;
  width: 100%;
}
section .signin .content .form .input-box input 
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
section .signin .content .form .input-box i 
{
  position: absolute;
  left: 0;
  padding: 15px 10px;
  font-style: normal;
  color: #aaa;
  transition: 0.5s;
  pointer-events: none;
}
.signin .content .form .input-box input:focus ~ i,
.signin .content .form .input-box input:valid ~ i
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
.signin .content .form .input-box .login-submit
{
  padding: 10px;
  background: #4ADE80;
  color: #000;
  font-weight: 600;
  font-size: 1.35em;
  letter-spacing: 0.05em;
  cursor: pointer;
}

.login-submit {
  padding: 10px;
  background: #4ADE80; 
  color: #000;
  font-weight: 600;
  font-size: 1em; 
  letter-spacing: 0.05em;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  border: none;
  border-radius: 4px;
  display: inline-block;
  width: 100%;
}

.login-submit:active
{
  opacity: 0.6;
}

.alert {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-radius: 4px;
  margin-top: 10px;
  font-size: 0.8em;
  color: #fff;
}

.alert.alert-danger {
  background: #ff4d4d;
}

.alert.alert-success {
  background: var(--primary);
}

.alert .close {
  cursor: pointer;
  background-color: transparent;
}

</style>