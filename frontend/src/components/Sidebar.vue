<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
import { ref } from 'vue'
import logoURL from '../assets/logo.png'

// Define a reactive variable to track the expanded/collapsed state of the sidebar
const is_expanded = ref(localStorage.getItem("is_expanded") === "true")

// Function to toggle the menu expansion state and update localStorage
const ToggleMenu = () => {
	is_expanded.value = !is_expanded.value
	localStorage.setItem("is_expanded", is_expanded.value)
}
</script>

<template>
	<!-- Sidebar component template -->
	<aside :class="`${is_expanded ? 'is-expanded' : ''}`">
		<!-- Logo section -->
		<div class="logo">
			<img :src="logoURL" alt="Vue" /> 
		</div>

		<!-- Menu toggle button -->
		<div class="menu-toggle-wrap">
			<button class="menu-toggle" @click="ToggleMenu">
				<span class="material-icons">keyboard_double_arrow_right</span>
			</button>
		</div>

		<!-- Heading for the menu section -->
		<h3>Menu</h3>

		<!-- Menu items section -->
		<div class="menu">
			<!-- Router link to the 'Meine Ablage' page -->
			<router-link to="/home" class="button">
				<span class="material-icons">folder_open</span>
				<span class="text">Meine Ablage</span>
			</router-link>
			
		</div>

		<div class="flex"></div>
		
		
	</aside>
</template>

<style lang="scss" scoped>
/* Scoped styles for the Sidebar component */
aside {
	// Basic styling for the Sidebar
	display: flex;
	flex-direction: column;

	background-color: var(--dark);
	color: var(--light);

	width: calc(2rem + 32px);
	overflow: hidden;
	min-height: 100vh;
	padding:1rem;

	transition: 0.2s ease-in-out;

	
	.flex {
		flex: 1 1 0%;
	}

	.logo {
		margin-bottom: 1rem;

		img {
			width: 2rem;
		}
	}

	// Styling for the menu toggle button
	.menu-toggle-wrap {
		display: flex;
		justify-content: center;
		margin-bottom: 1rem;

		position: relative;
		top: 0;
		transition: 0.2s ease-in-out;

		.menu-toggle {
			transition: 0.2s ease-in-out;
			background-color: transparent;
			padding: 0;
			
			
			.material-icons {
				font-size: 2rem;
				color: var(--light);
				transition: 0.2s ease-out;
			}
			
			&:hover {
				.material-icons {
					color: var(--primary);
					transform: translateX(0.5rem);
				}
			}
		}
	}

	// Styling for heading and menu items when sidebar is not expanded
	h3, .button .text {
		opacity: 0;
		transition: opacity 0.3s ease-in-out;
	}

	h3 {
		color: var(--grey);
		font-size: 0.875rem;
		margin-bottom: 0.5rem;
		text-transform: uppercase;
	}

	.menu {
		margin: 0 -1rem;

		.button {
			display: flex;
			align-items: center;
			text-decoration: none;

			transition: 0.2s ease-in-out;
			padding: 0.5rem 1rem;

			.material-icons {
				font-size: 2rem;
				color: var(--light);
				transition: 0.2s ease-in-out;
			}
			.text {
				color: var(--light);
				transition: 0.2s ease-in-out;
			}

			&:hover {
				background-color: var(--dark-alt);

				.material-icons, .text {
					color: var(--primary);
				}
			}

			&.router-link-exact-active {
				background-color: var(--dark-alt);
				border-right: 5px solid var(--primary);

				.material-icons, .text {
					color: var(--primary);
				}
			}
		}
	}

	.footer {
		opacity: 0;
		transition: opacity 0.3s ease-in-out;

		p {
			font-size: 0.875rem;
			color: var(--grey);
		}
	}

	// Styling when the sidebar is expanded
	&.is-expanded {
		width: var(--sidebar-width);
		z-index: 2;

		.menu-toggle-wrap {
			justify-content: flex-end;
			top: -3rem;
			
			.menu-toggle {
				
				
				transform: rotate(-180deg);
			}
		}
	
		// Show heading and menu items when expanded
		h3, .button .text {
			opacity: 1;
		}

		.button {
			.material-icons {
				margin-right: 1rem;
			}
		}

		.footer {
			opacity: 0;
		}
	}

	@media (max-width: 1024px) {
		position: fixed;
		z-index: 99;
		
	}
}
</style>