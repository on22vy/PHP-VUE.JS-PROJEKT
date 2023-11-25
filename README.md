# PHP-VUEJS-FILE-MANAGER
## Was braucht man für die Ausführung dieses Projekts?
* **Projekt Ordner**: kann man über github Zip-Ordner herunterladen oder klonen<br />
  Link zum Github: https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER
* **Docker Desktop**: <br />
  Hier zum Herunterladen: https://www.docker.com/products/docker-desktop/
* **npm**
* **IDE oder Texteditor** (VS Code empfohlen)



## Schritt 1: Projekt öffnen

* Öffnen Sie den Projektordner in Ihrer IDE oder einem Texteditor wie z.B. VS Code</br>
  
  <img width="263" alt="Screenshot 2023-11-25 150548" src="https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER/assets/116893308/a1422dec-523f-4839-888c-65c89ffcfc11">



## Schritt 2: Terminal öffnen

* Öffnen Sie das Terminal in VS Code: **Terminal > New Terminal**</br>
  <img width="434" alt="Screenshot 2023-11-25 150622" src="https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER/assets/116893308/753a703a-bba7-41c0-968a-6c9e4f3b6405">


## Schritt 3: Frontend einrichten
* Führen Sie die folgenden Befehle nacheinander im Terminal aus, um in den Ordner "frontend" zu gehen und die npm-Pakete zu installieren:

  ```powershell
  cd frontend
  ```
  ```powershell
  npm install
  ```
  ```powershell
  npm run build
  ```
  </br>

* Die erfolgreiche Ausgabe in Terminal sollte so aussehen:</br>
  <img width="349" alt="Screenshot 2023-11-25 155735" src="https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER/assets/116893308/6b99cb95-4068-479b-848a-91c9660f2ac7">

## Schritt 4: Backend einrichten
* Starten Sie die Docker Engine, indem Sie den Docker Desktop öffnen (Download [hier](https://www.docker.com/products/docker-desktop/)).
  <img width="1280" alt="Screenshot 2023-11-25 151314" src="https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER/assets/116893308/71a8ae7b-9a27-4fce-876e-d631070a3483">

</br>

* Sollte Docker Engine gestartet werden, können Sie dieses Screen in Docker Desktop sehen
  <img width="1280" alt="Screenshot 2023-11-25 151935" src="https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER/assets/116893308/169b47d6-15b0-4b59-a5dd-12cf474ac628">

</br>


* Gehen wieder in VS Code und führe im Terminal  den folgenden Befehl aus:
  ```powershell
  docker-compose up -d
  ```

</br>

* Warten Sie, bis der Downloadvorgang in Docker abgeschlossen ist. Wenn der Vorgang abgeschlossen ist, sollte im Terminal eine entsprechende Ausgabe erscheinen.</br>
  <img width="365" alt="Screenshot 2023-11-25 152511" src="https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER/assets/116893308/da76c8af-ef18-429d-9869-9773fc2a968e">

</br>

* Überprüfen Sie im Docker Desktop, ob die Container für das Projekt gelistet sind.</br>

  <img width="1280" alt="Screenshot 2023-11-25 152622" src="https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER/assets/116893308/da1e202d-5cf0-46eb-a06d-30af3543c6c1">

</br>

* Die App ist nun einsatzbereit. Öffnen Sie Ihren Webbrowser und gehen Sie zu http://localhost:8000, um die Anwendung zu verwenden.
</br>

* Verwenden Sie für die Anmeldung die folgenden Zugangsdaten:

  ```
  Benutzername: admin
  Passwort: 123456
  ```
</br>

* Nach erfolgreicher Anmeldung werden Sie zur Hauptseite weitergeleitet. Nun können Sie Dateien hochladen, öffnen, löschen, herunterladen oder umbenennen.


  ### !!!Hinweis: Mit der aktuellen Version sind Dateien mit einer Größe von bis zu 128 MB für den Upload zugelassen.


