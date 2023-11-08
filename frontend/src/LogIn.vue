<script setup>


</script>


<template>
    <div class="login-page">
      <img src="@/assets/logo.png" alt="Vue-Logo" class="logo"/>
      <button @click="login">Anmelden</button> 
      </div>

</template>

<style>
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Fira sans', sans-serif;
}

body {
	background: var(--light);
}

button {
	
  background-color: var(--primary);
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;

}

.login-page {
	display: flex;

	main {
		flex: 1 1 0;
		padding: 2rem;

		@media (max-width: 1024px) {
			padding-left: 6rem;
		}
	}
}
</style>