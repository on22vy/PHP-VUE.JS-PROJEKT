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
              <tbody>
                  <tr v-for="file in files" :key="file.id">
                    <td class="left">
                    <a :href="'../'+'php/'+file.path_to_file" target="_blank" class="file-name">
                      {{ file.filename }}
                      </a>
                      </td>
                      <td class="center">{{ file.filesize }}</td>
                      <td class="right">{{ file.created_date  }}</td>
                      <td class="right">
                     <button class="downloadButton material-icons">download</button>
                     <button @click="deleteFile(file.id)" class="deleteButton material-icons">delete</button>
          </td>
                   
                  </tr>

              </tbody>
          </table> 

   
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
  const deleteFile = (fileId) => {
  axios.delete('http://localhost:8000/php/deleteFile.php', {
    data: {
      fileId: fileId
    }
  })
    .then((response) => {
      // Erfolgreich gelöscht: Aktualisiere die Dateiliste, um die gelöschte Datei zu entfernen
      getAllFiles();
    })
    .catch((error) => {
      // Fehlerbehandlung, falls die Datei nicht gelöscht werden konnte
      console.error("Fehler beim Löschen der Datei: " + error);
    });
};

  // const showFile = (path) => {
  //   // Implement a mechanism to display the file when clicked.
  //   // You can open it in a new tab, use a modal, or other approaches.
  //   window.open(path, '_blank');
  // };

</script>

<style scoped>

.downloadButton {
  cursor: pointer;
  padding: 5px; /* Füge etwas Abstand zu den Icons hinzu */
  margin-left: 10px; /* Füge Abstand zwischen den Buttons und den anderen Elementen hinzu */
}
.deleteButton {
  cursor: pointer;
  padding: 5px; /* Füge etwas Abstand zu den Icons hinzu */
  margin-left: 10px; /* Füge Abstand zwischen den Buttons und den anderen Elementen hinzu */

}


.file-name:hover {
  text-decoration: underline;
}


  .fileView {
    background-color: #f2f2f2; /* Hintergrundfarbe für die Dateiansicht */
    padding: 10px; /* Innenabstand */
  }

  table {
    width: 100%; /* Volle Breite des Elternelements einnehmen */
    border-collapse: collapse; /* Tabellenzellen zusammenfassen */
  }

  th {
    text-align: left; /* Text links ausrichten */
    padding: 8px; /* Innenabstand für Zellen */
    background-color: #ccc; /* Hintergrundfarbe für Überschriften */

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
    background-color: #fff; /* Hintergrundfarbe für gerade Zeilen */
  }

  tr:nth-child(odd) {
    background-color: #f2f2f2; /* Hintergrundfarbe für ungerade Zeilen */
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
