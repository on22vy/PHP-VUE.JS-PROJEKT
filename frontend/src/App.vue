<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
</script>

<template>
	<!-- Content -->
	<router-view />
	

	
</template>

<style lang="scss">
:root {
	--primary: #4ade80;
	--primary-alt: #22c55e;
	--grey: #64748b;
	--dark: #1e293b;
	--light-grey:#F2F6FC;
	--dark-alt: #334155;
	--light: #ffffff;
	--sidebar-width: 300px;
}

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