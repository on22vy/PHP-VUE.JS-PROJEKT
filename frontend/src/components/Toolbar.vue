<template>
    <div class="toolWrapper">
        <div class="toggleView">
		    <button @click="show('list')" class="material-icons">list</button>
            <button @click="show('grid')" class="material-icons">grid_view</button>
	    </div>
        <!-- <button type = "file" class="uploadButton">Datei hochladen</button> -->
        <label class="uploadButton">
            <input type="file" style="display: none" ref="file" @change="onFileSelected"/>
            Datei hochladen
        </label>
        
    </div>
    <div class="viewContent">
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

<script setup>
import ListView from '../views/ListView.vue'
import GridView from '../views/GridView.vue'
import { ref } from 'vue'
import axios from 'axios'

const activeView = ref('list');

const show = (view) => {
  activeView.value = view;
};

const file = ref('');


const submitForm = () => {
  if (file.value) {
    const formData = new FormData();
    formData.append('file', file.value);

    axios.post('http://localhost/test-vue/backend/uploadfile.php', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })
    .then((data) => {
      console.log(data.data);
    })
    .catch(() => {
      console.log('FAILURE!!');
    });
  }
};

const onFileSelected = (event) => {
  // Update the file variable with the selected file
  file.value = event.target.files[0];

  // Automatically trigger the submitForm method
  submitForm();
};

</script>

<style lang="scss">
.toolWrapper {
    position: relative;
    height: 120px;


}

.toggleView {
    position: absolute;
    bottom: 10px;
    right: 10px;
    margin-right: 10px;
    button{
        font-size: 24px;
        margin-right: 20px;
    }
    
}

.viewContent {
    background-color: lightgray;
    height: 500px;
}

.uploadButton {
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
}

/* Responsive styles */
@media (max-width: 768px) {
  .toolWrapper {
    height: 60px; /* Adjust the height for smaller screens. */
  }

  .viewContent {
    height: 300px; /* Adjust the height for smaller screens. */
  }
}


</style>