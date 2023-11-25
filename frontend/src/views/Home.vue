<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
  import Toolbar from '../components/Toolbar.vue';
  import Sidebar from '../components/Sidebar.vue';
  import axios from 'axios';
  import {onMounted, ref} from 'vue';
  import { useRouter } from 'vue-router';

  const router = useRouter();

  const username = ref('');

  const response = () => {
    //Fetch user data when user has logged in successfully
    axios.get('http://localhost:8000/php/successLogin.php')
    .then((response) => {
      if (response.data.username) {
        // Set the username if available in the response
        username.value = response.data.username;
      }else {
        console.error(error);
      }    
    })
  }

  const logout = () => {
    // Perform logout by making a request to the server
    axios.get('http://localhost:8000/php/logout.php')
      .then(() => {
        // After successful logout, navigate to the login page
        router.push({ name: 'Login' });
      })
      .catch((error) => {
        console.error(error);
      });
  }

  onMounted(()=>
    {
      response();
    });

</script>

<template>
  <main class="home-page">
    <!-- Sidebar -->
    <Sidebar />

    <!-- Container for main content-->
    <div class="content">
      <!-- Container for welcome text and logout button -->
      <div class="welcome-container">
        <!--Welcome text-->
        <h1 class="welcome-text">👋 Welcome back, {{ username }}!</h1> <!--Display welcome text with username of the logged-in user--> 
        
        <!--Log out Button-->
        <button @click="logout()" class="logout-button">
          <span class="material-icons logout-icon">logout</span>
          Logout
        </button>
      </div>

      <!-- Container for Toolbar -->
      <div class="tools">
        <!-- Toolbar -->
        <Toolbar />
      </div>

      <!-- Container for file structure-->
      <div class="files-container">
        <!-- Placeholder for file structure displayed either in list view or grid view-->
      </div>

    </div>
  </main>
</template>

<style scoped>
.home-page {
  display: flex;
  flex-direction: column;

  @media (min-width: 768px) {
    flex-direction: row;
  }
}

.content {
  flex: 1; 
  margin: 2rem;
}

.welcome-container {
  margin-top: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
}

.logout-button {
  background-color: var(--light-grey);
  color: var(--dark);
  display: flex;
  align-items: center;
  font-weight: 600;
  margin-top: 1rem;
  order: -1; 

}

.logout-icon {
  margin-right: 5px;
}

@media (max-width: 768px) {
  .home-page {
    flex-direction: row;
  }

  .content {
    margin: 2rem;
    flex-direction: row; 
  }
  .logout-button {
    margin-top: 0.5rem; 
    position: absolute;
    top:0;
    right:0;
  }

  .welcome-container {
    order: 1; 
  }
  .welcome-text {
    margin-bottom: 2rem; 
    margin-left: calc(2rem + 32px);

  }
}



</style>