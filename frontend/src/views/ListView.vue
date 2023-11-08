<script setup>
/**
 * @author Acelya Cagan <acelya.cagan@gmail.com>
 */
  import axios from 'axios';
  import { ref, onMounted } from 'vue';

// List of files
  const files = ref("");

  
//Funtion to get all files
  const getAllFiles = () => {
    axios.get('http://localhost:8000/php/getFilesList.php', {
      headers: {
        'Content-Type': 'application/json',
      }
    })
    .then((response) => {
//Update file list
        files.value = response.data
// Call the 'getAllFiles' function again every 1000 milliseconds
        setTimeout(getAllFiles, 1000);
    })
    .catch(function(error){
        console.error("Failed to fetch data", error)
    });
  }
  
  
// Call the 'getAllFiles' function when loading the component
  onMounted(()=>
  {
    getAllFiles();
  });
//Function to delte the file
  const deleteFile = (fileId) => {

  axios.delete('http://localhost:8000/php/deleteFile.php', {
    data: {
      fileId: fileId
    }
  })
    .then((response) => {
     // Deleted successfully: Refresh the file list to remove the deleted file
      getAllFiles();
    })
    .catch((error) => {
// Error handling if the file could not be deleted
      console.error("Fehler beim Löschen der Datei: " + error);
    });
};
//Funtion to download the file
const downloadFile = (file) => {

    if (file) {
      // Create a link element
        const link = document.createElement('a');
        link.style.display = 'none';
        link.href = '../'+'php/'+file.path_to_file;
        link.target = '_blank';
        link.download = file.filename;

        // Add the link to the document and trigger it
        document.body.appendChild(link);
        link.click();
        
        //Remove the link
        document.body.removeChild(link);
    }
};

</script>

<template>
  <!-- <p>Test Grid</p> -->
  <div class="fileView">
          
           <table>
              <thead>
              <tr>
                  <th class="left">Filename</th>
                  <th class="center">Filesize</th>
                  <th class="right">Created</th>
                  <th class="actionHeader"></th>
                </tr>
              </thead>
              <tbody><!-- A loop through the files in the 'files' list-->
                  <tr v-for="file in files" :key="file.id">
                    <td class="left">
                      
                    <!-- A link to view or download the file -->
                    <a :href="'../'+'php/'+file.path_to_file" target="_blank" class="file-name">
                      {{ file.filename }}
                      </a>
                      </td>
                      <td class="center">{{ file.filesize }}</td>
                      <td class="right">{{ file.created_date  }}</td>
                      <td class="right">
                        
                    <!-- A button to download the file -->
                    <button @click="downloadFile(file)" class="downloadButton material-icons">download</button>
                    <!-- A button to delete the file -->
                     <button @click="deleteFile(file.id)" class="deleteButton material-icons">delete</button>
          </td>
                   
                  </tr>

              </tbody>
          </table> 

   
    </div>
</template>



<style scoped>

.downloadButton {
  cursor: pointer;
  padding: 5px; /* Add some space to the icons */
  margin-left: 10px; /* Add some space between the icons and elements */
}
.deleteButton {
  cursor: pointer;
  padding: 5px; /* Add some space to the icons */
  margin-left: 10px; /* Add some space between the icons and elements */
}


.file-name:hover {
  text-decoration: underline;
}


  .fileView {
    background-color: #f2f2f2; 
    padding: 10px; /* inner distance */
  }

  table {
    width: 100%; 
    border-collapse: collapse; /* Combine table cells */
  }

  th {
    text-align: left; /*  Align text left  */
    padding: 8px; /* Padding for cells */
    background-color: #ccc; 

  }
  td {
    text-align: center;
    padding:8px;
  }
  th.left {
    text-align: left;
  }

  th.center {
    text-align: center;
  }

  th.right {
    text-align: right;
  }

th.actionHeader {
  text-align: right;
  }
  tr:nth-child(even) {
    background-color: #fff; /* Background color for even line */
  }

  tr:nth-child(odd) {
    background-color: #f2f2f2; /* Background color for odd lines*/
  }
  td.left {
    text-align: left;
  }

  td.center {
    text-align: center;
  }

  td.right {
    text-align: right;
  }

  a {
    text-decoration: none;
    color: #000;
  }

 
</style>
