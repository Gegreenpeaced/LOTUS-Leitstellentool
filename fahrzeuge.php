<?php
require("downchecker.php");
include("sessionssetter_a.php");

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
        include("meta.php");
        ?>
        <title>Fahrzeuge | LOTUS-Leitstelle</title>
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
                <header class="content-header">Fahrzeuge</header>
                <?php
                if($_GET['msg'] == 1)
                {
                echo "<div class='info-box-sucess'>";
                    echo "<div class='sucess'>Erfolg! Das Fahrzeug mit der Wagennummer " . $_GET['nmr'] . " wurde erfolgreich gelöscht!</div>";
                echo "</div>";
                }
                if($_GET['msg'] == 2)
                {
                  echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Das Fahrzeug mit der Wagennummer " . $_GET['nmr'] . " wurde nicht gelöscht!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 3)
                {
                  echo "<div class='info-box-info'>";
                      echo "<div class='info'>Info! Das Formular sollte nicht manipuliert werden!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 4)
                {
                  echo "<div class='info-box-sucess'>";
                      echo "<div class='info'>Erfolg! Das Fahrzeug mit der Nummer " . $_GET['nmr'] . " wurde erfolgreich registriert!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 5)
                {
                  echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Das Fahrzeug mit der Nummer " . $_GET['nmr'] . " wurde nicht registriert!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 6)
                {
                  echo "<div class='info-box-sucess'>";
                      echo "<div class='info'>Erfolg! Die Parameter des Fahrzeuges mit der Nummer " . $_GET['nmr'] . " wurde erfolgreich geändert!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 7)
                {
                  echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Parameter des Fahrzeuges mit der Nummer " . $_GET['nmr'] . " wurde nicht geändert!</div>"; //
                  echo "</div>";
                }
                if($_GET['msg'] == 8)
                {
                  echo "<div class='info-box-info'>";
                      echo "<div class='info'>Info! Die Parameter des Fahrzeuges mit der Nummer " . $_GET['nmr'] . " wurden ggf. nicht komplett geändert! Kontaktieren sie einen Administrator!</div>";
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
                            <th>Fahrzeugnummer</th>
                            <th>Fahrzeugtyp</th>
                            <th>Fahrzeugbezeichnung</th>
                            <th>Fahrgastplätze</th>
                            <th>Trittstufen</th>
                            <th>Zweirichter</th>
                            <th>Traktionsfähig</th>
                            <th>Spurweite</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res = mysqli_query($con, "SELECT * FROM `lst_fahrzeuge`");
                        if(mysqli_num_rows($res) > 0)
                        {
                          while($dsatz = mysqli_fetch_assoc($res))
                          {
                            echo "<form action='fahrzeugchangehandler.php' method='POST'>";
                            echo "<input type='hidden' name='send' value='1337'>";
                            echo "<input type='hidden' name='old_nmr' value='" . $dsatz['f_nmr'] . "'>";
                            echo "<tr class='left'>";
                            echo "<td><input type='text' name='vehicle_number' value='". $dsatz['f_nmr'] . "'/></td>";
                            if($dsatz['f_class'] == 0)
                            {
                              echo "<td><select name='vehicle_class' id='vehicle_class'><option value='0' selected='selected' >Bus</option><option value='1'>Straßenbahn</option></select></td>";
                            }
                            if($dsatz['f_class'] == 1)
                            {
                              echo "<td><select name='vehicle_class' id='vehicle_class'><option value='0'>Bus</option><option value='1' selected='selected' >Straßenbahn</option></select></td>";
                            }
                            echo "<td>" . $dsatz['f_typ'] . "</td>";
                            echo "<td><input type='text' name='vehicle_platz' value='" . $dsatz['f_platz'] . "'/></td>";
                            if($dsatz['f_stufen'] == 0)
                            {
                              echo "<td><select name='vehicle_stairs' id='vehicle_stairs'><option value='1'>Ja</option><option value='0' selected='selected'>Nein</option></select></td>";
                            }
                            if($dsatz['f_stufen'] == 1)
                            {
                              echo "<td><select name='vehicle_stairs' id='vehicle_stairs'><option value='1' selected='selected'>Ja</option><option value='0'>Nein</option></select></td>";
                            }
                            if($dsatz['f_zr'] == 0)
                            {
                              echo "<td><select name='vehicle_twoway' id='vehicle_twoway'><option value='1'>Ja</option><option value='0' selected='selected'>Nein</option></select></td>";
                            }
                            if($dsatz['f_zr'] == 1)
                            {
                              echo "<td><select name='vehicle_twoway' id='vehicle_twoway'><option value='1' selected='selected'>Ja</option><option value='0'>Nein</option></select></td>";
                            }
                            if($dsatz['f_trak'] == 0)
                            {
                              echo "<td><select name='vehicle_traction' id='vehicle_traction'><option value='1'>Ja</option><option value='0' selected='selected'>Nein</option></select></td>";
                            }
                            if($dsatz['f_trak'] == 1)
                            {
                              echo "<td><select name='vehicle_traction' id='vehicle_traction'><option value='1' selected='selected'>Ja</option><option value='0'>Nein</option></select></td>";
                            }
                            if($dsatz['f_gauge'] == 1000)
                            {
                              echo "<td><select name='vehicle_gauge' id='vehicle_gauge'><option value='1000' selected='selected'>1000 Millimeter</option><option value='1435'>1435 Millimeter</option></select></td>";
                            }
                            if($dsatz['f_gauge'] == 1435)
                            {
                              echo "<td><select name='vehicle_gauge' id='vehicle_gauge'><option value='1000'>1000 Millimeter</option><option value='1435' selected='selected'>1435 Millimeter</option></select></td>";
                            }
                            echo "<td><input type='submit' class='lstbutton-login' value='Änderung übernehmen'/></input></form> ";
                            echo "<form action='fahrzeugremoverhandler.php' method='POST'>";
                            echo "<input type='hidden' name='send' value='1337'>";
                            echo "<input type='hidden' name='vehicle_remove' value='" . $dsatz['f_nmr'] . "'>";
                            echo "<input type='submit' class='lstbutton-login-remove' value='Fahrzeug löschen'/></input></td>";
                            echo "</form>";
                            echo "</tr>";
                          }
                        }
                        ?>
                        <tr>
                            <td class="grey"></td>
                            <td class="grey"></td>
                            <td class="grey"></td>
                            <td class="grey"></td>
                            <td class="grey"></td>
                            <td class="grey"></td>
                            <td class="grey"></td>
                            <td class="grey"></td>
                            <td class="grey"></td>
                        </tr>
                        <?php
                        echo "<tr class='left'>";
                        echo "<form action='fahrzeughandler.php' method='POST'>";
                          echo "<td><input type='text' name='vehicle_number' require ></td>";
                          echo "<input type='hidden' name='send' value='1337' require >";
                          echo "<td><select name='vehicle_class' id='vehicle_class'><option value='0'>Bus</option><option value='1'>Straßenbahn</option></select></td>";
                          echo "<td>";
                          include("mysql_config.php");
                          $con2 = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                          mysqli_select_db($con2, "$MYSQL_DB"); //Auswahl der Datenbank
                          $res2 = mysqli_query($con2, "SELECT * FROM `sys_vehicle` WHERE 1");
                          if(mysqli_num_rows($res2) > 0)
                          {
                          echo "<select name='vehicle_typ' id='vehicle_typ'>";
                            while($dsatz2 = mysqli_fetch_assoc($res2))
                            {
                              echo "<option value='" . $dsatz2['name'] . "'>" . $dsatz2['name'] . "</option>";
                            }
                          }
                          else {
                            echo "Keine Fahrzeuge bekannt!";
                          }
                          mysqli_close($con2);
                          echo "</td>";
                          echo "<td><input type='text' name='vehicle_people' require/></td>";
                          echo "<td><select name='vehicle_stairs' id='vehicle_stairs'><option value='1'>Ja</option><option value='0'>Nein</option></select></td>";
                          echo "<td><select name='vehicle_twoway' id='vehicle_twoway'><option value='1'>Ja</option><option value='0'>Nein</option></select></td>";
                          echo "<td><select name='vehicle_traction' id='vehicle_traction'><option value='1'>Ja</option><option value='0'>Nein</option></select></td>";
                          echo "<td><select name='vehicle_gauge' id='vehicle_gauge'><option value='1000'>1000 Millimeter</option><option value='1435'>1435 Millimeter</option></select></td>";
                          echo "<td><input type='submit' class='lstbutton-login' value='Fahrzeug hinzufügen'></input>  <input type='reset' class='lstbutton-login-remove'></input>";
                          echo "</form>";
                          echo "</td>";
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
