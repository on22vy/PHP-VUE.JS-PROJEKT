<template>
    <!-- <p>Test Grid</p> -->
    <div class="fileView">
            
            <!-- <table>
                <thead>
                    <th>Filename</th>
                    <th>Filesize</th>
                    <th>Created</th>
                    
                </thead>
                <tbody>
                    <tr v-for="file in files">
                        <td>{{ file.filename }}</td>
                        <td>{{ file.filesize }}</td>
                        <td>{{ file.created_date  }}</td>
                        
                    </tr>
                </tbody>
            </table> -->

        <div class="grid-container">
          <div class="file-box" v-for="file in files">
            <a :href="'../'+'php/'+file.path_to_file" target="_blank">
            <div class="file-details">
              <div class="filename">{{ file.filename }}</div>
              <div class="filesize">{{ file.filesize }}</div>
              <div class="created-date">{{ file.created_date }}</div>
            </div>
          </a>
          </div>
        </div>
      </div>
</template>
  
<script setup>
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

   
  
    // const showFile = (path) => {
    //   // Implement a mechanism to display the file when clicked.
    //   // You can open it in a new tab, use a modal, or other approaches.
    //   window.open(path, '_blank');
    // };
</script>
<style>
.fileView {
  display: flex;
  justify-content: center;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjust the column width as needed */
  gap: 20px; /* Adjust the gap between grid items */
  grid-auto-flow: column;
}

.file-box {
  border: 1px solid #ccc;
  padding: 10px;
  cursor: pointer;
  transition: background-color 0.2s;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.file-box:hover {
  background-color: #f0f0f0;
}

.file-details {
  text-align: center;
  margin-top: 10px;
}

.filename {
  font-weight: bold;
}

</style>
  