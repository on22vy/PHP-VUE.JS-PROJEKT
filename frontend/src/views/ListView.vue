
<template>
  <div>
    <h2>Liste der Dateien</h2>
    <div class="file-list"></div>
    <ul>
      <li v-for="(file, index) in fileList" :key="index" class="file-item">
        <a :href="file.url" target="_blank" class="file-link">{{ file.name }} </a>
       
        <div class="button-group">
         <span class="downloadButton material-icons" @click="downloadFile(file)">download</span>
         <span class="deleteButton material-icons" @click="() => deleteFile(file)">delete</span>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      fileList: [],
    };
  },

  methods: {
      async fetchFileList() {
  try {
    const response = await axios.get('/php/openFile.php'); // Relativer Pfad zur PHP-Datei
    console.log(response.data); // Überprüfen Sie die Serverantwort
    const files = response.data;
    this.fileList = files.map(file => ({
      name: file,
      url: `/uploads/${file}`, // Stellen Sie sicher, dass der Pfad zum Upload-Ordner korrekt ist
    }));
  } catch (error) {
    console.error('Fehler beim Abrufen der Dateiliste:', error);
  }
},
downloadFile(file) {
  const a = document.createElement('a');
  
  // Setzen Sie die URL der ausgewählten Datei (file, nicht this.files)
  a.href = file.url;

  // Geben Sie der Datei einen Namen für den Download (file.name, nicht selectedFile.name)
  a.download = file.name;

  // Fügen Sie das Link-Element zum Dokument hinzu
  document.body.appendChild(a);

  // Klicken Sie auf den Link, um den Download zu starten
  a.click();

  // Entfernen Sie das Link-Element aus dem Dokument
  document.body.removeChild(a);
}
},
deleteFile(file) {
      
      axios.post('/php/deleteFile.php', { filename: file.name })
        .then(response => {
          if (response.data.success) {
            // Erfolgreich gelöscht, aktualisieren Sie die Dateiliste
            this.fetchFileList();
          } else {
            // Fehler beim Löschen
            console.error('Fehler beim Löschen der Datei.');
          }
        })
        .catch(error => {
          console.error('Fehler beim Löschen der Datei:', error);
        });
    },
  
created() {
    this.fetchFileList();
  },
};
</script>

<style scoped>

.deleteButton,
.downloadButton {
  cursor: pointer;
  padding: 5px; /* Füge etwas Abstand zu den Icons hinzu */
  margin-left: 10px; /* Füge Abstand zwischen den Buttons und den anderen Elementen hinzu */
}

.file-link{
  color: black;
  flex:1;
}
.file-item {
  display: flex;
  width: 100%;
  justify-content: space-between;
  align-items: center;
  padding: 2px;
  border: 2px solid var(--light);
  background-color: var(--light);
  margin-block: 10px;

}
.button-group {
  display: flex;
  align-items: center;
  gap: 10px; /* Abstand zwischen den Buttons anpassen */
}
.last-changed-date {
  flex: 2;
  text-align: center;
}

.file-name {
  flex: 1;
  text-decoration: none;
  cursor: pointer;
  color: var(--dark);
}

.file-name:hover {
  text-decoration: underline;
}

.user-name {
  flex: 3;
}

.file-list {
  padding: 10px;
}

</style>