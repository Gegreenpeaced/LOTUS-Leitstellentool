<?php
include("sessionssetter.php");

?>
<!DOCTYPE html>
<html lang="de">
    <head>
      <?php
      include("meta.php");
       ?>
        <title>Liveboard | LOTUS-Leitstelle</title>
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
                <header class="content-header">Liveboard</header>
                <div class="content-main">
                    <div class="content-box">
                      <div class="content-box-space-small">
                      </div>
                      <div class="content-box-space-small">
                      </div>
                      <div class="content-box-space-small">
                      </div>
                      <div class="content-box-space-small">
                      </div>
                    </div>
                    <div class="content-box">
                    <div class="content-box-nospace-long">
                        <div class="content-box-text">
                            <h1 class="content-box-text-h1">Fahrtzettel</h1>
                            <h2 class="content-box-text-h2">Karte: $map
                            <h2 class="content-box-text-h2">Wagennummer: $vehicle_number</h2>
                            <h2 class="content-box-text-h2">Fahrzeug: $vehicle_typ</h2>
                            <h2 class="content-box-text-h2">Umlauf: $route</h2>
                        </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Downloads</h1>
                        <h2 class="content-box-text-h2">Umlaufkarte: <button class="lstbutton-login">Download</button></h2>
                        <h2 class="content-box-text-h2">Fahrzeug-Handbuch: <button class="lstbutton-login">Download</button></h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Statusmeldungen</h1>
                        <h2 class="content-box-text-h2">Ziel: <select id="desti_stat_lst"><option name="d_loerik">D. Lörick</option><option name="d_hbf">D. Hauptbahnhof</option></select></h2>
                        <h2 class="content-box-text-h2">Statusmeldungen: <select id="status_stat_lst"><option name="none">Kein Sprechwunsch</option><option name="delay">Verspätet</option><option name="accident">Unfall</option></select></h2>
                        <h2 class="content-box-text-h2">Verspätungen: <select id="delay_stat_lst"><option name="5">über 5 Minuten</option><option name="10">über 10 Minuten</option><option name="15plus">über 15 Minuten</option></select></h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                        <div class="content-box-text">
                            <h1 class="content-box-text-h1">Anweisungen der Leitstelle</h1>
                            <h2 class="content-box-text-h2">Wagen 2024: Fahren sie nur bis Rheinbahnhaus!<!-- Hier müsste eine Datenbankabfrage rein --></h2>
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
