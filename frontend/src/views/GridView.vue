<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
  
  import axios from 'axios';
  import { ref, onMounted, onUnmounted } from 'vue';

  // Variables to hold metadata of files and active file ID for dropdown
  const files = ref("");
  const activeFileId = ref(null);

  // Function to toggle the dropdown on clicking the three dots button
  const toggleDropdown = (fileId) => {
    activeFileId.value = fileId === activeFileId.value ? null : fileId;
  };
  
  // Function to close dropdown when clicking outside the dropdown
  const closeDropdown = (event) => {
    const clickedElement = event.target;

    if (!clickedElement.closest('.three-dots-btn')) {
      activeFileId.value = null;
  }
  };

  // Attach event listeners when component is mounted and remove them when unmounted
  onMounted(() => {
    document.addEventListener('click', closeDropdown);
  });

  onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
  });

  // Function to retrieve existing/uploaded files from the server
  const getAllFiles = () => {
    axios.get('http://localhost:8000/php/getFilesList.php', {
      headers: {
        'Content-Type': 'application/json',
      }
    })
    .then((response) => {
        files.value = response.data
        // Schedule a periodic refresh of file list every second to ensure that file list stays updated by changes in database
        setTimeout(getAllFiles, 1000);
    })
    .catch(function(error){
        console.error("Failed to fetch data", error)
    });
  }

  // Function to delete a file by its ID
  const deleteFile = (fileId) => {
    axios.delete('http://localhost:8000/php/deleteFile.php', {
      data: {
        fileId: fileId
      }
    })
      .then(() => {
       // Successfully deleted: Refresh the file list to remove the deleted file
        getAllFiles();
      })
      .catch((error) => {
        // Error handling if the file couldn't be deleted
        console.error("Fehler beim Löschen der Datei: " + error);
      });
  };

  // Function to download a file
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
  
  // Function to rename a file
  const renameFile = (file) => {
    // Prompt the user for typing a new filename
    const newFilename = prompt("Neuer Dateiname:", file.filename);

    if (newFilename) {
      // Send a request to the server to rename the file
      axios.put('http://localhost:8000/php/renameFile.php', {
        fileId: file.id,
        newFilename: newFilename
      })
      .then((response) => {
        console.log(response); 
        getAllFiles(); // Refresh the file list
      })
      .catch((error) => {
        // Error handling if the file couldn't be renamed
        console.error("Fehler beim Umbenennen der Datei: " + error);
      });
    }
  };

  // Function to truncate a filename for display if the filename is too long
  const truncateFileName = (filename) => {
    if (filename.length > 20) {
      return filename.slice(0, 20) + '...';
    }
    return filename;
  };

  // Initial fetch of files when the component is mounted
  onMounted(()=>
  {
      getAllFiles();
  });

  

</script>

<template> 
  <div class="file-view">
    <!-- The grid container for files -->
    <div class="grid-container">
      <!-- File box for each file -->
      <div class="file-box" v-for="file in files">

        <!-- Dropdown Menu container with three dot button -->
        <div class="action-container">
          <button class="material-icons three-dots-btn" @click="toggleDropdown(file.id)">more_vert</button> 

          <!-- Dropdown content with available actions on file: delete, download, rename -->
          <ul class = "dropdown-content" :class="{ 'show-dropdown': file.id === activeFileId }">

             <!-- Delete file button -->
            <li class="dropdown-item">
              <button class = "delete-btn" @click="deleteFile(file.id)">
                <span class="material-icons">delete</span>
				        <span class="text">Delete</span>
              </button>
            </li>

             <!-- Download file button -->
            <li class="dropdown-item">
              <button class = "download-btn" @click="downloadFile(file)">
                <span class="material-icons">download</span>
				        <span class="text">Download</span>
              </button>
              
            </li>

            <!-- Rename file button -->
            <li class="dropdown-item">
              <button class = "rename-btn" @click="renameFile(file)">
                <span class="material-icons">edit</span>
				        <span class="text">Rename</span>
              </button>
            </li>
            
          </ul>
        </div>
        
        <!-- Open File in new tab in browser -->
        <!-- Create file url based on path of file that was retrieved from server/database -->
        <a :href="'../'+'php/'+file.path_to_file" target="_blank">
          <!-- File Icon -->
          <div class="material-icons file-icon">description</div>

          <!-- File infos -->
          <div class="file-details">
            <!-- Display truncated filename -->
            <div class="filename" :title="file.filename">{{ truncateFileName(file.filename) }}</div>
            <!-- Display created date of file -->
            <div class="created-date">{{ file.created_date }}</div>
          </div>
        </a>

      </div>
    </div>
  </div>
</template>
  
<style scoped>
/* .file-view {
  display: flex;
 
} */

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); 
  gap: 20px; 
  grid-auto-flow: row;
}

.file-box {
  border-radius: 5px;
  background-color: #E4E4E4;
  padding: 10px;
  transition: background-color 0.2s;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  position: relative; 
  left: calc(2rem + 32px);

}

.file-box:hover {
  background-color: var(--light-grey);
}

.action-container {
  position: relative;
  display: flex;
  align-self: flex-end;
}

.three-dots-btn{
  width: 40px; /* Set the width and height for circular button */
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center; 
  justify-content: center;
  background-color: transparent;
  color: var(--dark);
  transition: background-color 0.2s;
  cursor: pointer;
}

.three-dots-btn:hover{
  background-color: var(--light);
}

.dropdown-content{
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  min-height: 100px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  top: 40px;
  padding: 15px 0;
  margin-top: 9px;
  border-radius: 4px;
}

.show-dropdown{
  display: block;
}

.dropdown-item{
  margin: 0;
  list-style: none;
  padding: 0;
}

.delete-btn, 
.download-btn,
.rename-btn{
  min-width: 100%;
  color: black;
  border-radius: 0;
  background-color: transparent;
  cursor: pointer;
  display: block;
  font-size: 14px;
  line-height: 18px;
  padding: 5px 20px;
  position: relative;
  white-space: nowrap;
  transition: background-color 0.3s, color 0.3s;
  display: flex; 
  align-items: center;
  .material-icons{
    font-size: 15px;
    margin-right: 10px;
  }
}

.delete-btn:hover, 
.download-btn:hover,
.rename-btn:hover{
  background-color: var(--light-grey);
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
@media screen and (max-width: 768px) {

  .file-box {
    width: calc(100% - 2 * (2rem + 32px)); 
  }
}
.show-dropdown {
    display: block;
    left: -60px;
  }


</style>
  