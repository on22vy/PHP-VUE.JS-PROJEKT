<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
import Toolbar from '../components/Toolbar.vue'
import Sidebar from '../components/Sidebar.vue'
</script>

<template>
    <main class="homePage">
       
       <!-- Sidebar -->
		  <Sidebar />
      <div class="content">
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
  :is(main) {
		flex: 1 1 0;
		padding: 2rem;

		@media (max-width: 1024px) {
			padding-left: 6rem;
		}
	}
}

.content {
  display: flex;
  flex-direction: column;
  flex: 1; /* Take remaining space */
  margin: 2rem;
}

</style>
   