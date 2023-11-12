<script setup>

</script>


<template>
  
    <div class="login-page">

      <div class="content-container">
        <h1 class="welcome-text">Willkommen in deinem Filemanager!</h1>
        <div class="centered-content">

        <div class="logo">
          <img src="@/assets/logo.png" alt="Vue-Logo"/> </div>

      <button @click="login" class="button">Jetzt öffnen</button> 

      </div>
    </div>
  </div>

</template>

<style scoped>

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Fira sans', sans-serif;
}

body {
	background: #f1f5f9;
}
.button {
  background-color: #4ade80;
  color:#f1f5f9;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 20px; /* Fügen Sie etwas Abstand über dem Button hinzu */
}
.button:hover {
  background-color: #64748b;
}
.logo {
	margin-bottom: 1rem;

	& img {
    padding: 20px;
		width: 14rem; /* Hier die Breite auf 2rem erhöhen, um das Logo zu vergrößern */
		margin-bottom: 0.5rem; /* Etwas Abstand unterhalb des Logos hinzufügen */
	}
}

.login-page {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh; /* 100% der Bildschirmhöhe einnehmen */
}

.welcome-text {
  font-size: 1.5rem; 
  text-align: center;
  color: #64748b;
  margin-top: 1rem; 
}
.content-container {
  border: 2px solid #64748b; 
  padding: 10px; 
  border-radius: 10px; 
}
.centered-content {
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>