<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */

  import axios from 'axios';
  import { ref, onMounted } from 'vue';

  const files = ref("");

  const getAllFiles = () => {
    axios.get('http://localhost:8000/php/getFilesList.php', {
      headers: {
        'Content-Type': 'application/json',
      }
    })
    .then((response) => {
        files.value = response.data
        setTimeout(getAllFiles, 1000);
    })
    .catch(function(error){
        console.error("Failed to fetch data", error)
    });
  }
  
  
  onMounted(()=>
  {
    getAllFiles();
  });
</script>

<template>
    <!-- <p>Test Grid</p> -->
    <div class="fileView">
      <div class="grid-container">
        <div class="file-box" v-for="file in files">
          <div class="action-container">
            <button class="material-icons action-button">more_vert</button> 
          </div>
          
          <a :href="'../'+'php/'+file.path_to_file" target="_blank">
            <div class="material-icons file-icon">description</div>
            <div class="file-details">
              <div class="filename">{{ file.filename }}</div>
              <!-- <div class="filesize">{{ file.filesize }}</div> -->
              <div class="created-date">{{ file.created_date }}</div>
            </div>
          </a>

        </div>
      </div>
  </div>
</template>
  
<style lang='scss' scoped>
.fileView {
  display: flex;
 
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjust the column width as needed */
  gap: 20px; /* Adjust the gap between grid items */
  grid-auto-flow: column;
}

.file-box {
  border-radius: 5px;
  background-color: var(--light-grey);
  padding: 10px;
  transition: background-color 0.2s;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
}

.file-box:hover {
  background-color: #E4E4E4;
}

.action-container {
    display: flex;
    align-self: flex-end;
}

.action-button{
  width: 40px; /* Set the width and height for circular button */
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center; /* Center vertically */
  justify-content: center;
  background-color: transparent;
  color: var(--dark);
  transition: background-color 0.2s;
  cursor: pointer;
}

.action-button:hover{
  background-color: var(--light);
}

.file-details {
  text-align: center;
  margin-top: 10px;
}

.filename {
  font-weight: bold;
  font-size: 16px;
}

.created-date{
  font-size: 14px;

}

a{
  text-decoration: none;
  text-align: center;
  color: var(--dark);
}

.file-icon{
  padding: 10px;
  font-size: 50px;
}
</style>
  