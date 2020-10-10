
###Inhaltsverzeichnis:
1. Allgemeine Erklärungen
2. Installation
3. Software aktualisieren
4. Administration innerhalb des Tools
5. Urheberrechtshinweise

___
###1. Allgemeine Erklärungen

Diese Software basiert auf PHP 7.2, HTML5.0 und Java Script. Sie wurde von Julius Reiter für das Spiel LOTUS-Simulator geschrieben, natürlich kann es auch für jeden anderen Zweck verwendet werden, doch die vereinbarte Lizenz sollte eingehalten werden(Siehe 6.).
Das Programm wurde zuletzt am 10.8.2020 auf Funktionsfähigkeit getestet. Alle auftretenden Probleme können auf Github im Tab "ISSUES" gestellt werden.


###2. Installation

Als erster Schritt sollte sichergestellt werden das ein Apache Server mit **mindestens** PHP 7.2 und dazugehöriger MYSQL Erweiterung sowie Datenbank vorhanden ist.
Im zweiten Schritt muss der letzte öffentliche Release der Software heruntergelanden werden. Dies kann unter folgendem Link passieren: "**Link einfügen**".
Im nächsten Schritt muss die Software entpackt werden. Zum korrekten Entpacken empfehle ich 7-ZIP.
Nach dem Entpacken muss der Inhalt des Ordners in das **htdocs** Verzeichnis kopiert werden. Das im Ordner **mysql_installation** existierende Script muss in PHPMyamin ausgeführt werden.
Um erfolgreich ein Benutzerkonto zu erstellen muss mit sich mit folgendem Token registriert werden: "__**TOKEN EINSETZEN**__" . (Achtung:Token ist nur für einmalige Nutzung bestimmt und wird nach de Benutzen gelöscht!)
Mit dem eben erstellten Benutzerkonto ist es jetzt möglich sich anzumelden. Um Administratorrechte zu erhalten muss in der Tabelle: **sys_user** der Eintrag des entsprechenden Nutzers in der Spalte **u_rechte** auf **3** geändert werden.

###3. Software aktualisieren
Sollte ein wichtiges Update für die Software erscheinen so sollten folgende Schritte befolgt werden:
1. Laden sie sich aus dem "Release" Ordner die **Update** Version herrunter. Folgen sie den schritten in der Readme.md Datei.

###4. Administration innerhalb des Tools

**Weitere Informationen folgen!**