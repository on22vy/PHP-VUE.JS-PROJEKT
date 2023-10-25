<script>
export default {
  data() {
    return {
      files: [
      {
        name: "Dokument1.pdf",
        lastChangedDate: "2023-10-24",
        userName: "Alice",
        url: "https://example.com/documents/Dokument1.pdf"
      },
      {
        name: "Bild.png",
        lastChangedDate: "2023-10-23",
        userName: "Bob",
        url: "https://example.com/images/Bild.png"
      },
      {
        name: "Bericht.docx",
        lastChangedDate: "2023-10-22",
        userName: "Charlie",
        url: "https://example.com/documents/Bericht.docx"
      }
    ]
    };
  },
methods: {
downloadFile(file) {
      const a = document.createElement('a');
       a.href = file.url;
       a.download = file.name; // Verwende den Dateinamen der aktuellen Datei
        document.body.appendChild(a);
        // Klicke auf den Link, um den Download zu starten
        a.click();
      // Entferne den Link aus dem Dokument, nachdem der Download abgeschlossen ist
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
      <span class="downloadButton material-icons" @click="() => downloadFile(file)">download</span>
      
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