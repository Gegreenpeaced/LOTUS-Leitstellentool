<?php
session_start();

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
        include("meta.php");
        ?>
        <title>Impressum | LOTUS-Leitstelle</title>
    </head>
    <body>
        <main class="app">
            <nav class="sidebar">
                <header class="sidebar-header">
                  <?php
                    include("navmenu.php");
                    include("footer.php");
                    ?>
            </nav>
            </div>
            <nav class="space">
            </nav>
            <nav class="content">
                <header class="content-header">Impressum</header>
                <div class="content-main">
                    <div class="content-box">
                    <div class="content-box-nospace-long">
                        <div class="content-box-text">
                            <h1 class="content-box-text-h1">Entwickler:</h1> <!-- Änderungen sind hier nicht erlaubt!-->
                            <h2 class="content-box-text-h2">Website und Design:  Julius Reiter</h2>
                            <h2 class="content-box-text-h2">IRC-Script: Wagen300</h2>
                        </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Danksagungen:<h1>
                        <h2 class="content-box-text-h2">DrBlackError - Danke für den Webspace</h2>
                        <h2 class="content-box-text-h2">Akuba - Danke fürs Fehler beheben</h2>
                        <h2 class="content-box-text-h2">Paulter - Danke fürs Fehler beheben</h2>
                        <h2 class="content-box-text-h2">Pandemist - Danke fürs Fehler beheben</h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Datenspeicherung:</h1>
                        <h2 class="content-box-text-h2">Hier könnt ihr eure Datenschutzerklärungen verlinken oder angeben. Sind ja durch die DSGVO noch mal spezieller geworden ;-)</h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                        <div class="content-box-text">
                            <h1 class="content-box-text-h1">Kontakt:</h1>
                            <h2 class="content-box-text-h2">Hauptansprechpartner: DrBlackError</h2>
                            <h2 class="content-box-text-h2">E-Mail: business "at" drblackerror.de</h2>
                            <h2 class="content-box-text-h2">Discord: DrBlackError#3531</h2>
                            <h2 class="content-box-text-h2">Hier könnte dann alles wichtige eingetragen werden im Bezug auf das Telekommunikationsgesetz ;-)<!-- Hier müsste eine Datenbankabfrage rein --></h2>
                        </div>
                    </div>
                  </div>
                </div>
            </nav>
            <nav class="logout-bar">
                &nbsp;
            </nav>
            <br>
        </main>
    </body>
</html>
