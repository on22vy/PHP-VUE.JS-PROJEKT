<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
import ListView from '../views/ListView.vue'
import GridView from '../views/GridView.vue'
import { ref } from 'vue'
import axios from 'axios'

// Variable that refers to the currently active view (initially set to 'list')
const activeView = ref('list');

// Function to switch between list and grid views
const show = (view) => {
  activeView.value = view;
};

// Reactive variable to hold the selected file from local
const file = ref('');

// Function triggered when a file is selected/clicked
const onFileSelected = (event) => {
  // Update the file variable with the selected file
  file.value = event.target.files[0];

  // Automatically trigger the upload method
  upload();
};


// Function to send/upload the data to server
const upload = () => {
  if (file.value) {
    // Create form data and append the selected file
    const formData = new FormData();
    formData.append('file', file.value);

    // Perform a POST request to upload the file
    axios.post('http://localhost:8000/php/uploadFile.php', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })
    .then((data) => {
      console.log(data.data); // Log the response data on success
    })
    .catch(() => {
      console.log('FAILURE!!'); // Log failure if request fails
    });
  }
};


</script>

<template>
    <!-- Toolbar section -->
    <div class="tool-wrapper">
        <!-- 2 Buttons to switch between list and grid view -->
        <div class="toggle-view">
		      <button @click="show('list')" class="material-icons">list</button>
          <button @click="show('grid')" class="material-icons">grid_view</button>
	      </div>
        
        <!-- File upload button -->
        <label class="upload-button">
            <span class="material-icons">cloud_upload</span>
            <!-- Hidden input field on UI for triggering file selection -->
            <input type="file" style="display: none" ref="file" @change="onFileSelected"/>
            File Upload
        </label>
        
    </div>

    <!-- View content based on choosen active view -->
    <div class="view-content">
            <!-- Render ListView or GridView -->
            <div v-if="activeView === 'list'">
              <!-- List View Content -->
                <ListView/>
        
            </div>
            
            <div v-else-if="activeView === 'grid'">
              <!-- Grid View Content -->
                <GridView/>
       
            </div>  
    </div>
	
</template>

<style lang="scss">
.tool-wrapper {
    position: relative;
    height: 120px;
    margin-left: calc(2rem + 32px)


}

.toggle-view {
    position: absolute;
    bottom: 10px;
    right: 10px;
    margin-right: 10px;
    button{
        font-size: 24px;
        margin-right: 20px;
    }
    
}

.view-content {
    height: 500px;
    margin-top: 20px;
}

.upload-button {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: var(--primary);
    color: white;
    padding: 15px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 700;
    display: flex; 
    align-items: center;
}
.upload-button .material-icons {
  margin-right: 10px; /* Add space between icon and text */
}

/* Responsive styles */
@media (max-width: 768px) {
    .tool-wrapper {
        height: auto;
        flex-direction: column;
        margin-left: calc(2rem + 32px)
    }
    .view-content {
        height: 300px; 
    }

    .toggle-view {
        position: static; 
        display: block; 
        margin-top: 10px; 
        button {
            margin-right: 10px; 
        }
    }

    .upload-button {
        position: static;
        margin-top: 10px;
        padding: 8px 12px; 
        font-size: 14px; 
        width: 50%; 
    }
}

</style>