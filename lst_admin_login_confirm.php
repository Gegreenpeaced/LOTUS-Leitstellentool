<?php
require("downchecker.php");
include("sessionssetter.php");

?>
<!DOCTYPE html>
<html lang="de">
    <head>
      <?php
      include("meta.php");
       ?>
        <title>Anmeldungen für die Leitstellenfahrt | LOTUS-Leitstelle</title>
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
            <nav class="space">
            </nav>
            <nav class="content">
                <header class="content-header">Anmeldungen für die Leitstellenfahrt</header>
                <?php
                if($_GET['msg'] == 1)
                {
                  echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Nutzer wurde erfolgreich freigeschaltet!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 2)
                {
                  echo "<div class='info-box-error'>";
                    echo "<div class='error'>Fehler! Der Nutzer konnte nicht freigeschaltet werden! KONTAKTIEREN sie einen Admin!</div>";             // ZWEITE SCHLEIFE WAR $num NEGATIV! DATENBANK BERICHTIGEN
                  echo "</div>";
                }
                if($_GET['msg'] == 3)
                {
                  echo "<div class='info-box-info'>";
                    echo "<div class='info'>Info! Formular darf nicht manipuiert werden!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 4)
                {
                  echo "<div class='info-box-error'>";
                    echo "<div class='error'>Fehler! Der Nutzer konnte nicht freigeschaltet werden!</div>";             // ERSTE SCHLEIFE WAR $num NEGATIV
                  echo "</div>";
                }
                ?>
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
                    <div class="table">
                    <table id="sttable">
                        <tr>
                            <th>Name</th>
                            <th>Spawnpunkt</th>
                            <th>Umlauf</th>
                            <th>Fahrzeug</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res = mysqli_query($con, "SELECT `l_user` FROM `lst_login_fahrt` WHERE `lst_confirm`='0'");
                        if(mysqli_num_rows($res) > 0)
                        {                                                                                                             // ROUTEN ANPASSEN!
                          while($dsatz = mysqli_fetch_assoc($res))
                          {
                            echo "<form action='handler/lstloginhandler.php' method='POST'>";
                            echo "<input type='hidden' name='name' value='" . $dsatz['l_user'] . "'>";
                            echo "<input type='hidden' name='send' value='1337'>";
                            echo "<tr>";
                            echo "<td>" . $dsatz['l_user'] . "</td>";
                            echo "<td><input type='text' name='spawn' placeholder='Spawnpunkt' require></input></td>";
                            $map = mysqli_query($con, "SELECT `lst_map` FROM `lst_fahrten` WHERE `lst_login_pb` = '1'");
                            $r_map_fetch = mysqli_fetch_assoc($map);
                            $sql_routes = "SELECT * FROM `lst_routes` WHERE `r_map` = '" . $r_map_fetch['lst_map'] . "' AND `r_lst_used`='0'";
                            echo "<input type='hidden' name='map' value='" . $r_map_fetch['lst_map'] . "'>";
                            $routes = mysqli_query($con, $sql_routes);
                            if(mysqli_num_rows($routes) > 0)
                            {
                              echo "<td><select name='route'>";


                                while ($options_routes = mysqli_fetch_assoc($routes))
                                {
                                    echo "<option value='" . $options_routes['r_nmr'] . "'>" . $options_routes['r_nmr'] . "</option>";
                                }

                                echo "</select></td>";

                            }
                            else {
                              echo "<td>Keine Umläufe mehr verfügbar!</td>";
                            }


                            $vehicle = mysqli_query($con, "SELECT * FROM `lst_fahrzeuge` WHERE `used`='0'");
                            if(mysqli_num_rows($vehicle) > 0)
                            {
                              echo "<td><select name='vehicle'>";

                              while ($vehicle_options = mysqli_fetch_assoc($vehicle))
                              {
                                echo "<option value'" . $vehicle_options['f_nmr'] . "'>" . $vehicle_options['f_nmr'] . "</option>";
                              }

                              echo "</select></td>";
                            }
                            else {
                              echo "<td>Keine Fahrzeuge verfügbar</td>";
                            }

                            echo "<td><input type='submit' class='lstbutton-login' value='Anmeldung annehmen'></form></td>";

                            echo "</tr>";
                          }
                        }
                        else
                        {
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                        }
                        mysqli_close($con);
                        ?>
                    </table>
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
