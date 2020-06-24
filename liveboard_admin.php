<?php
include("sessionssetter_a.php");

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
        include("meta.php");
        ?>
        <title>LEITSTELLE | LOTUS-Leitstelle</title>
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
                <header class="content-header">LEITSTELLE</header>
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
                            <h1 class="content-box-text-h1">Nutzerübersicht</h1>
                            <h2 class="content-box-text-h2">Gegreenpeaced - 2023 - D.Lörick - 0 min</h2>
                            <h2 class="content-box-text-h2">$user - $nummer - $desti - $delay</h2>
                        </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Sprechwünsche</h1>
                        <h2 class="content-box-text-h2">Gegreenpeaced - Unfall</h2>
                        <h2 class="content-box-text-h2">$user - $freq_code</h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                      <div class="content-box-text">
                        <h1 class="content-box-text-h1">Statusmeldungen</h1>
                        <h2 class="content-box-text-h2">2023 - D. Lörick - Störung</h2>
                        <h2 class="content-box-text-h2">$nummer - $dest - $stat</h2>
                      </div>
                    </div>
                    <div class="content-box-nospace-long">
                        <div class="content-box-text">
                            <h1 class="content-box-text-h1">Anweisungen</h1>
                            <h2 class="content-box-text-h2">Wagen 2023 - Warten sie auf Feuerwehr!</h2>
                            <select id="v_number"><option name="2023">2023</option><option name="4023">4023</option></select>  <input class="submit-input-contentbox" type="text" placeholder="Nachricht"></input>  <input type="submit" class="lstbutton-login" value="Senden"></input>
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
