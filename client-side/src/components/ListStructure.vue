<script>
export default {
  data() {
    return {
      files: [
        // hier erstelle ich ein Array mit dem die Info über die Datei wie Dateiname und Benuetzername übergeben wird

        { name: 'Datei1.txt', userName: 'Benutzer1' },
        { name: 'Datei2.jpg', userName: 'Benutzer2' },
        { name: 'Datei3.pdf', userName: 'Benutzer3' }
      ]
    };
  },
  methods: {
    deleteFile(index) {
      // mit dieser Methode lösche ich das Element aus dem Array
      this.files.splice(index, 1);
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
      <div class="file-list">
        <div v-for="(file, index) in files" :key="index" class="file-item">
          <div class="file-name">{{ file.name }}</div>
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
  height: 100%; /* Füllt die  Höhe des Bildschirms aus */
  position: fixed; /* Fixierte Position, um es am linken Rand zu halten */
  top: 0;
  left: 0;
  overflow-y: auto; /* Bei Bedarf scrollbar machen */
}
.content {
  margin-left: 250px; /* Platz für die Navigationsleiste einräumen */
  padding: 5px;
}

/* Stile für Ihre Navigationsleiste */

/* Navigationspunkte an der Sidebar mittig setzen*/

.sidebar ul {
  list-style: none;
  padding: 50px;
}
/* Abstand zwischen den Navigationspunkte an der Sidebar */
.sidebar li {
  padding: 10px;
}
/* Liste in dem mein Inhalt drin steht */

.file-list {
  padding: 10px;
}

.file-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 5px solid #20a8a8;
  padding: 10px;
  margin-top: 50px;
}

.file-name {
  flex: 1;
}

.user-name {
  flex: 1;
}
/* Name meines Filemanagers */

.sidebar li.larger-text {
  padding: 10px;
  font-size: 25px; /* Hier kann ich die gewünschte Schriftgröße angeben */
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
