<script setup>


</script>


<template>

    <div class="login-page">
      <img src="@/assets/logo.png" alt="Vue-Logo" class="logo"/>
      <button @click="login" class="button">Anmelden</button> 
      </div>

</template>

<style lang="scss">

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Fira sans', sans-serif;
}

body {
	background: var(--light);
}
.button {
  background-color: var(--primary);
  color:var(--light);
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 20px; /* Fügen Sie etwas Abstand über dem Button hinzu */
}
.logo {
	margin-bottom: 1rem;

	img {
		width: 2rem; /* Hier die Breite auf 2rem erhöhen, um das Logo zu vergrößern */
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
</style>