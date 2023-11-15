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
    axios.get('http://localhost:8000/php/successLogin.php')
    .then((response) => {
      if (response.data.username) {
        username.value = response.data.username;
      }else {
        console.error(error);
      }    
    })
  }

  const logout = () => {
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
  <main class="homePage">
    <!-- Sidebar -->
    <Sidebar />
    <div class="content">
      <div class="welcome-container">
        <h1 class="welcome-text">👋 Welcome back, {{ username }}!</h1>
        <button @click="logout()" class="logout-button">
          <span class="material-icons logout-icon">logout</span>
          Logout
        </button>
      </div>
      <div class="tools">
        <!-- Toolbar -->
        <Toolbar />
      </div>
      <div class="filesContainer">
        <!-- Entweder FileStructur oder Kachel -->
      </div>
    </div>
  </main>
</template>

<style scoped>
.homePage {
  display: flex;
  flex-direction: column;

  @media (min-width: 768px) {
    flex-direction: row;
  }
}

.content {
  flex: 1; /* Take remaining space */
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
  margin-right: 5px; /* Add space between icon and text */
}

@media (max-width: 768px) {
  .homePage {
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