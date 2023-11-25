# PHP-VUEJS-FILE-MANAGER
## Was braucht man für die Ausführung dieses Projekts?
* **Projekt Ordner**: kann man über github Zip-Ordner herunterladen oder klonen<br />
  Link zum Github: https://github.com/on22vy/PHP-VUEJS-FILE-MANAGER
* **Docker Desktop**: <br />
  Hier zum Herunterladen: https://www.docker.com/products/docker-desktop/
* **npm**
* **IDE oder Texteditor** (VS Code empfohlen)



## Schritt 1: Projekt öffnen

* Öffnen Sie den Projektordner in Ihrer IDE oder einem Texteditor wie z.B. VS Code




Schritt 2: Terminal öffnen

Öffnen Sie das Terminal in VS Code: Terminal > New Terminal
Abb. 49:neues Terminal in VS Code öffnen


Schritt 3: Frontend einrichten
Führen Sie die folgenden Befehle nacheinander im Terminal aus, um in den Ordner "frontend" zu gehen und die npm-Pakete zu installieren:

cd frontend
npm install
npm run build


Die erfolgreiche Ausgabe in Terminal sollte so aussehen:

Schritt 4: Backend einrichten
Starten Sie die Docker Engine, indem Sie den Docker Desktop öffnen (Download hier).


Sollte Docker Engine gestartet werden, können Sie dieses Screen in Docker Desktop sehen



Gehen wieder in VS Code und führe im Terminal  den folgenden Befehl aus:
docker-compose up -d



Warten Sie, bis der Downloadvorgang in Docker abgeschlossen ist. Wenn der Vorgang abgeschlossen ist, sollte im Terminal eine entsprechende Ausgabe erscheinen. 
Abb. 49: erfolgreiche Herunterladen von Docker Container



Überprüfen Sie im Docker Desktop, ob die Container für das Projekt gelistet sind.




Die App ist nun einsatzbereit. Öffnen Sie Ihren Webbrowser und gehen Sie zu http://localhost:8000, um die Anwendung zu verwenden.

Verwenden Sie für die Anmeldung die folgenden Zugangsdaten:

Benutzername: admin
Passwort: 123456


Nach erfolgreicher Anmeldung werden Sie zur Hauptseite weitergeleitet. Nun können Sie Dateien hochladen, öffnen, löschen, herunterladen oder umbenennen.

!!!Hinweis: Mit der aktuellen Version sind Dateien mit einer Größe von bis zu 128 MB für den Upload zugelassen.


