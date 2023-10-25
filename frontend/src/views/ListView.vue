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
    <div class="deleteButton">
        <span class="material-icons">delete</span>
    </div>

    <div @click="() => downloadFile(file)" class="downloadButton">
        <span class="material-icons">download</span>
    </div>
</div>
</div>
</template>

<style scoped>

.deleteButton{
 position: absolute;
 height:320px;
 right:150px;
 cursor: pointer;
}
.downloadButton{
 position: absolute;
 height:320px;
 right:100px;
 cursor: pointer;
}


</style>