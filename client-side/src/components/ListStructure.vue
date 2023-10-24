<script>
export default {
  data() {
    return {
      files: [
        // hier erstelle ich ein Array mit dem die Info über die Datei wie Dateiname und Benuetzername übergeben wird

        { name: 'Datei1.txt', lastChangedDate: '11.11.2023',userName: 'Benutzer1' },
        { name: 'Datei2.jpg', lastChangedDate: '15.11.2023',userName: 'Benutzer2' },
        { name: 'Datei3.pdf', lastChangedDate: '28.11.2023',userName: 'Benutzer3' }
      ]
    };
  },
  methods: {
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
      const selectedFile = event.target.files[0];
      // Fügen Sie Ihren Code zur Verarbeitung der hochgeladenen Datei hier ein
    },
    triggerFolderInput() {
      // Klicken Sie auf das versteckte Ordner-Input-Feld
      this.$refs.folderInput.click();
    },
    handleFolderUpload(event) {
      // Hier können Sie den ausgewählten Ordner verarbeiten
      const selectedFolder = event.target.files[0];
      // Fügen Sie Ihren Code zur Verarbeitung des ausgewählten Ordners hier ein
    }
  }
};
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
      <div class="upload-container">
      <div class="file-upload" @click="triggerFileInput">+ Datei hochladen</div>
      <div class="folder-upload" @click="triggerFolderInput">+ Ordner hochladen</div>
      

      <input type="file" ref="folderInput" style="display: none" @change="handleFolderUpload" webkitdirectory directory accept="*/" />
      <input type="file" ref="fileInput" style="display: none" @change="handleFileUpload" multiple />
  </div>

  <div class="file-list-header">
      <p class="file-header">Dateiname</p>
      <p class="date-header">Zuletzt geändert am</p>
      <p class="user-header">Benutzername</p>
    </div>
    
      <div class="file-list">
        <div v-for="(file, index) in files" :key="index" class="file-item">
          <div class="file-name">{{ file.name }}</div>
          <div class="last-changed-date">{{ file.lastChangedDate }}</div>
          <div class="user-name">{{ file.userName }}</div>
          <button @click="deleteFile(index)" class="delete-button">Löschen</button>
          
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
  margin-left: 250px; /* Platz für die Navigationsleiste einräumen */
  padding: 10px;
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
  padding: 10px;
  margin-top: 60px;
}

.file-name {
  flex:1;
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
  color: #20a8a8;
  cursor: pointer;
  border: 2px solid #20a8a8;
  margin-right: 20px; /* Abstand zwischen den Buttons */
}


.delete-button {
  background-color: rgb(63, 158, 170);
  border-radius: 30px;
  color: white;
  border: none;
  cursor: pointer;
  width: 250px;
  height: 50px;
}
</style>
