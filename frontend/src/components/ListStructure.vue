<script>
export default {
  data() {
    return {
      files: [
        // hier erstelle ich ein Array mit dem die Info über die Datei wie Dateiname und Benuetzername übergeben wird

        
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
    },
    deleteFile(index) {
      // mit dieser Methode lösche ich das Element aus dem Array
      this.files.splice(index, 1);
    },
    triggerFileInput() {
      // Klicken Sie auf das versteckte Datei-Input-Feld
      this.$refs.fileInput.click();
    },
    handleFileUpload(event) {
      // Hier können Sie den hochgeladenen Dateiinhalt verarbeiten
      const selectedFiles = event.target.files;

      for (let i = 0; i < selectedFiles.length; i++) {
        const selectedFile = selectedFiles[i];
        // Verarbeiten Sie jede ausgewählte Datei und fügen Sie sie zur Dateiliste hinzu.
        const fileData = {
          name: selectedFile.name, // Dateiname
          lastChangedDate: new Date().toLocaleDateString(), // Aktuelles Datum
          userName: 'Benutzer', // Benutzername (passe dies an)
          url:  URL.createObjectURL(selectedFile)// URL zur Datei (passe dies an)
        };
        this.files.push(fileData);
      }
    },

    triggerFolderInput() {
      // Klicken Sie auf das versteckte Ordner-Input-Feld
      this.$refs.folderInput.click();
    },
    handleFolderUpload(event) {
      // Hier können Sie den ausgewählten Ordner verarbeiten
      const selectedFolder = event.target.files[0];
      // Fügen Sie Ihren Code zur Verarbeitung des ausgewählten Ordners hier ein
    },
    
    openFileContent(file) {
      // Prüfe, ob die Datei eine PDF ist
      if (file.url.toLowerCase().endsWith('.pdf')) {
        // Öffne die PDF-Datei in einem neuen Fenster/Tab
        window.open(file.url, '_blank');
      } else {
        // Hier könntest du Logik hinzufügen, um andere Dateitypen zu öffnen oder eine Fehlermeldung anzuzeigen
        console.log('Dieser Dateityp wird nicht unterstützt.');
  }
}
  }
}
</script>

<template>
  
  <div>
    <!-- Navigationsleiste links-->
    <nav class="sidebar">
      <ul>
        <li class="larger-text"><router-link to="/">VA-Filemanager</router-link></li>
        <!--router link ermöglicht die Navigation innerhalb der Anwendung-->
        <li><router-link to="/meinedateien">Meine Dateien</router-link></li>
        <li><router-link to="/gelöschedateien">Gelöschte Dateien</router-link></li>
      </ul>
    </nav>
    <p class="left-align">Hello Benutzer!</p>

   

    <div class="content">
      <!--Hochladen von Datei und Ordner-->
      <div class="upload-container">
      <div class="file-upload" @click="triggerFileInput">+ Datei hochladen</div>
      <div class="folder-upload" @click="triggerFolderInput">+ Ordner hochladen</div>
      <input type="file" ref="folderInput" style="display: none" @change="handleFolderUpload" webkitdirectory directory accept="*/" />
      <input type="file" ref="fileInput" style="display: none" @change="handleFileUpload" multiple />
  </div>

        <!--Überschriften der Listenansicht-->
  <div class="file-list-header">
      <p class="file-header">Dateiname</p>
      <p class="date-header">Zuletzt geändert am</p>
      <p class="user-header">Benutzername</p>
    </div>

    
          <!--Eintrag-->
      <div class="file-list">
        <div v-for="(file, index) in files" :key="index" class="file-item">
          <a :href="file.url" target="_blank" @click="openFileContent(file)" class="file-name">{{ file.name }}</a>
          <div class="last-changed-date">{{ file.lastChangedDate }}</div>
          <div class="user-name">{{ file.userName }}</div>
          <button @click="deleteFile(index)" class="delete-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
          </svg>
          </button>
          <button @click="() => downloadFile(file)" class="download-button">
           <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
          <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
           </svg>
           </button>

        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.sidebar {
  width: 250px;
  background-color: #20a8a8;
  color: white;
  height: 100%; /* Füllen Sie die Höhe des Bildschirms aus */
  position: fixed; /* Fixierte Position, um es am linken Rand zu halten */
  top: 0;
  left: 0;
  overflow-y: auto; /* Bei Bedarf scrollbar machen */
}
/*Begrüung benutzer*/
.left-align {
  text-align: left;
  font-size: 25px;
  margin: 0;
  padding: 20px;
  position: absolute; /* Ändern Sie die Position auf absolute */
  left: 380px; /* Verschieben Sie das Element nach rechts, um Platz für die Navigation zu lassen */
  top:50px;
}

.content {
  margin-left: 200px; /* Platz für die Navigationsleiste einräumen */
  width: 100%;
}


/* Stile für Ihre Navigationsleiste */
.sidebar ul {
  list-style: none;
  padding: 0;
}

.sidebar li {
  padding: 10px;
}

.sidebar a {
  color: white;
  text-decoration: none;
}

.file-list {
  padding: 10px;
}


@media( max-width:600px){
  .file-item,.content,.file-name,.user-name{
  width:100%
  
}
}
@media( max-width:601px){
  .file-item,.content,.file-name,.user-name{
  width:100%
  
}
}
@media( max-width:768px){
  .file-item,.content,.file-name,.user-name{
  width:100%
  
}
}
@media( max-width:992px){
  .file-item,.content,.file-name,.user-name{
  width:100%
  }
}
@media( max-width:1200px){
  .file-item,.content,.file-name,.user-name{
  width:100%
  
}
}
.file-item {
  display: flex;
  width: 150%;
  justify-content: space-between;
  align-items: center;
  border: 5px solid #20a8a8;
  padding: 2px;
  margin-block: 10px;
  margin-right: 90px;
}
.file-list-header{
align-items: center;
width: 95%;
justify-content: space-between;
display:flex;
margin-block: 10px;
margin-left:60px;
}
.file-name {
  flex:1;
  text-decoration: none;
  color:#377bab;
  cursor: pointer;
}
.file-name:hover {
  text-decoration: underline;
}
.last-changed-date{
  flex:1;
  text-align: center;
}
.user-name {
  flex: 1;
  
}

.sidebar li.larger-text {
  padding: 30px;
  font-size: 25px; /* Hier können Sie die gewünschte Schriftgröße angeben */
}

/*Styles for the button*/

/* create two colums */
.upload-container {
  display: flex; 
  align-items: center;
}

.folder-upload,
.file-upload {
  display: flex; /* Hier verwenden wir Flexbox */
  justify-content: center; /* Zentriert den Text horizontal */
  align-items: center; /* Zentriert den Text vertikal */
  background: white;
  width: 140px;
  height: 50px;
  border-radius: 10px;
  cursor: pointer;
  border: 2px solid #20a8a8;
  margin-right: 20px; /* Abstand zwischen den Buttons */

}
.folder-upload:hover,.file-upload:hover{
  background-color: #20a8a8;
  color: #ffff;
}

.delete-button {
border-radius: 50px;
  border: none;
  margin-right: 20px;
  cursor: pointer;
  width: 50px;
  height: 50px;
}

.download-button {
  border-radius: 50px;
  border: none;
  cursor: pointer;
  width: 50px;
  height: 50px;
}
</style>
