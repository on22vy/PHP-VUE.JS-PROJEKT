<script setup>
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
  
  import axios from 'axios';
  import { ref, onMounted, onUnmounted } from 'vue';
  // import DropdownMenu from '../components/Dropdown.vue';

  const files = ref("");
  const activeFileId = ref(null);

  const toggleDropdown = (fileId) => {
    activeFileId.value = fileId === activeFileId.value ? null : fileId;
  };
  
  const closeDropdown = (event) => {
    const clickedElement = event.target;

    if (!clickedElement.closest('.threeDotsBtn')) {
      activeFileId.value = null;
  }
  };

  onMounted(() => {
    document.addEventListener('click', closeDropdown);
  });

  onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
  });

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

  const deleteFile = (fileId) => {
    axios.delete('http://localhost:8000/php/deleteFile.php', {
      data: {
        fileId: fileId
      }
    })
      .then(() => {
        // Erfolgreich gelöscht: Aktualisiere die Dateiliste, um die gelöschte Datei zu entfernen
        getAllFiles();
      })
      .catch((error) => {
        // Fehlerbehandlung, falls die Datei nicht gelöscht werden konnte
        console.error("Fehler beim Löschen der Datei: " + error);
      });
  };

  const downloadFile = (file) => {
    if (file) {
        const link = document.createElement('a');
        link.style.display = 'none';
        link.href = '../'+'php/'+file.path_to_file;
        link.target = '_blank';
        link.download = file.filename;
        
        document.body.appendChild(link);
        link.click();
        
        document.body.removeChild(link);
    }
  };
  
  const renameFile = (file) => {
    const newFilename = prompt("Neuer Dateiname:", file.filename);

    if (newFilename) {
      axios.put('http://localhost:8000/php/renameFile.php', {
        fileId: file.id,
        newFilename: newFilename
      })
      .then((response) => {
        console.log(response); // Hier die Serverantwort ausgeben
        getAllFiles();
      })
      .catch((error) => {
        console.error("Fehler beim Umbenennen der Datei: " + error);
      });
    }
  };

  const truncateFileName = (filename) => {
    if (filename.length > 20) {
      return filename.slice(0, 20) + '...';
    }
    return filename;
  };

  onMounted(()=>
  {
      getAllFiles();
  });

  

</script>

<template> 
  <div class="fileView">
    <div class="grid-container">
      <div class="file-box" v-for="file in files">

        <div class="action-container">
          <button class="material-icons threeDotsBtn" @click="toggleDropdown(file.id)">more_vert</button> 
          <ul class = "dropdown-content" :class="{ 'show-dropdown': file.id === activeFileId }">
            <li class="dropdown-item">
              <button class = "delete-btn" @click="deleteFile(file.id)">
                <span class="material-icons">delete</span>
				        <span class="text">Delete</span>
              </button>
            </li>
            <li class="dropdown-item">
              <button class = "download-btn" @click="downloadFile(file)">
                <span class="material-icons">download</span>
				        <span class="text">Download</span>
              </button>
              
            </li>
            <li class="dropdown-item">
              <button class = "rename-btn" @click="renameFile(file)">
                <span class="material-icons">edit</span>
				        <span class="text">Rename</span>
              </button>
            </li>
            
          </ul>
        </div>
        
        <a :href="'../'+'php/'+file.path_to_file" target="_blank">
          <div class="material-icons file-icon">description</div>
          <div class="file-details">
            <div class="filename" :title="file.filename">{{ truncateFileName(file.filename) }}</div>
            <div class="created-date">{{ file.created_date }}</div>
          </div>
        </a>

      </div>
    </div>
  </div>
</template>
  
<style scoped>
/* .fileView {
  display: flex;
 
} */

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjust the column width as needed */
  gap: 20px; /* Adjust the gap between grid items */
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
}

.file-box:hover {
  background-color: var(--light-grey);
}

.action-container {
  position: relative;
  display: flex;
  align-self: flex-end;
}

.threeDotsBtn{
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

.threeDotsBtn:hover{
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
</style>
  