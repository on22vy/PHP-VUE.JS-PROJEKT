<script>
export default {
  data() {
    return {
        files: [
        {
          name: "Dokument1.pdf",
          url: "URL_ZU_PDF1"
        },
        {
          name: "Dokument2.pdf",
          url: "URL_ZU_PDF2"
        }
        // Weitere Dateien
      ]
    };
  },
methods: {
    openFileContent(file) {
      // Prüfe, ob die Datei eine PDF ist
      if (file.url.toLowerCase().endsWith('.pdf')) {
        // Öffne die PDF-Datei in einem neuen Fenster/Tab
        window.open(file.url, '_blank');
      } else {
        // Hier könntest du Logik hinzufügen, um andere Dateitypen zu öffnen oder eine Fehlermeldung anzuzeigen
        console.log('Dieser Dateityp wird nicht unterstützt.');
  }
},
downloadFile(file) {
    const a = document.createElement('a');
      
      // Finden Sie die ausgewählte Datei im Array (z.B., die erste Datei)
      const selectedFile = this.files[0];

      // Setzen Sie die URL der ausgewählten Datei
      a.href = selectedFile.url;

      // Geben Sie der Datei einen Namen für den Download
      a.download = selectedFile.name;

      // Fügen Sie das Link-Element zum Dokument hinzu
      document.body.appendChild(a);

      // Klicken Sie auf den Link, um den Download zu starten
      a.click();

      // Entfernen Sie das Link-Element aus dem Dokument
      document.body.removeChild(a);

}
}
}
</script>


<template>
    
    <h2>List View </h2>

    <div class="file-list">
    <div v-for="(file, index) in files" :key="index" class="file-item">
      <a :href="file.url" target="_blank" @click="openFileContent(file)" class="file-name">{{ file.name }}</a>
      <div class="last-changed-date">{{ file.lastChangedDate }}</div>
      <div class="user-name">{{ file.userName }}</div>

      <!-- Download-Button -->
      <span class="downloadButton material-icons" @click=" downloadFile(file)">download</span>
      
      <!-- Löschen-Button -->
      <span class="deleteButton material-icons" @click="() => deleteFile(file)">delete</span>
    </div>
  </div>

</template>

<style scoped>

.deleteButton,
.downloadButton {
  cursor: pointer;
  padding: 5px; /* Füge etwas Abstand zu den Icons hinzu */
  margin-left: 10px; /* Füge Abstand zwischen den Buttons und den anderen Elementen hinzu */
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