<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
</script>

<template>
	<!-- The main template for the application -->
	<!-- This is where the content of app will be displayed. -->
	<router-view />
		
</template>

<style lang="scss">
/* Define custom CSS variables */
:root {
	--primary: #4ade80;
	--primary-alt: #22c55e;
	--grey: #64748b;
	--dark: #1e293b;
	--light-grey:#ccc;
	--dark-alt: #334155;
	--light: #ffffff;
	--sidebar-width: 300px;
}

/* Global CSS styles */
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Quicksand', sans-serif;
	font-weight: 500;
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
  font-weight: 700;

}


</style>