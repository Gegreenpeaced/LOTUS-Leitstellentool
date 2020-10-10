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
        <title>Umläufe | LOTUS-Leitstelle</title>
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
                <header class="content-header">Umläufe</header>
                <div class="content-main">
                  <?php
                    if($_GET['msg'] == 1)
                    {
                      echo "<div class='info-box-info'>";
                          echo "<div class='info'>Das Formular darf nicht manipuliert werden!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 2)
                    {
                      echo "<div class='info-box-sucess'>";
                          echo "<div class='sucess'>Erfolg! Der Umlauf der Karte " . $_GET['map'] . " mit der Nummer " . $_GET['nmr'] . " wurde erfolgreich hinzugefügt!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 3)
                    {
                      echo "<div class='info-box-error'>";
                          echo "<div class='error'>Fehler! Der Umlauf der Karte " . $_GET['map'] . " mit der Nummer " . $_GET['nmr'] . " wurde nicht hinzugefügt!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 4)
                    {
                      echo "<div class='info-box-sucess'>";
                          echo "<div class='sucess'>Erfolg! Der Umlauf mit der ID " . $_GET['id'] . " wurde erfolgreich entfernt!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 5)
                    {
                      echo "<div class='info-box-error'>";
                          echo "<div class='error'>Erfolg! Der Umlauf mit der ID " . $_GET['id'] . " wurde nicht entfernt!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 6)
                    {
                      echo "<div class='info-box-sucess'>";
                          echo "<div class='sucess'>Erfolg! Die Parameter des Umlaufes der Map " . $_GET['map'] . " und der Nummer " . $_GET['nmr'] . " wurden erfolgreich geändert!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 7)
                    {
                      echo "<div class='info-box-error'>";
                          echo "<div class='error'>Fehler! Die Parameter des Umlaufes der Map " . $_GET['map'] . " und der Nummer " . $_GET['nmr'] . " wurden nicht geändert!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 8)
                    {
                      echo "<div class='info-box-info'>";
                          echo "<div class='info'>Info! Die Parameter wurden ggf. nicht geändert! Kontaktieren sie einen Administrator!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 9)
                    {
                      echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Die Route wurde zwar hinzugefügt, doch das verlinken des Downloades hat nicht funktioniert! Bitte Datensatz löschen!</div>";
                      echo "</div>";
                    }
                    ?>
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
                            <th>Umlaufnummer</th>
                            <th>Karte</th>
                            <th>Umlauf Code</th>
                            <th>Download-Center</th>
                            <th>Download-Center-Kategorie</th>
                            <th>Endpunkt 1</th>
                            <th>Endpunkt 2</th>
                            <th>Wochentage</th>
                            <th>Optionen</th>
                        </tr>
                        <tr>
                          <?php
                          include("mysql_config.php");
                          $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                          mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                          $res = mysqli_query($con, "SELECT * FROM `lst_routes`");
                          if(mysqli_num_rows($res) > 0)
                          {
                            while($dsatz = mysqli_fetch_assoc($res))
                            {
                                                                      // $dl_center_card = mysqli_query($con, "SELECT `link` FROM `dl_center` WHERE `prim` = '" . $dsatz['r_prim'] . "'");         NOT WORKING CONTACT @  AKKUBAHN
                                echo "<tr>";
                                echo "<form action='routechangehandler.php' method='post'>";
                                echo "<input type='hidden' name='route_prim' value='" . $dsatz['r_prim'] . "'>";
                                echo "<input type='hidden' name='send' value='1337'>";
                                echo "<td><input type='text' name='route_number' value='" . $dsatz['r_nmr'] . "'></input></td>";
                                echo "<td>" . $dsatz['r_map'] . "</td><input type='hidden' name='route_map' value='" . $dsatz['r_map'] . "'>";
                                echo "<td><input type='text' name='route_code' value='" . $dsatz['r_code'] . "'></input></td>";
                                echo "<td>N/A</td>";                // LATER   <-----   <a class='lstbutton-login-a' href='$dl_center_card'>Umlaufkarte</a>
                                echo "<td>" . $dsatz['r_dl_cat'] . "</td>";
                                echo "<input type='hidden' name='route_dl_cat' value='" . $dsatz['r_dl_cat'] . "'>";
                                echo "<td><input type='text' name='route_dest_one' value='" . $dsatz['r_dest_one'] . "'></td>";
                                echo "<td><input type='text' name='route_dest_two' value='" . $dsatz['r_dest_two'] . "'></td>";
                                if($dsatz['r_day'] == 1)
                                {
                                echo "<td><select name='day' id='day'><option value='1' selected='selected'>Mo-Fr</option><option value='2'>Sa</option><option value='3'>So</option></select></td>";
                                }
                                if($dsatz['r_day'] == 2)
                                {
                                echo "<td><select name='day' id='day'><option value='1' >Mo-Fr</option><option value='2' selected='selected'>Sa</option><option value='3'>So</option></select></td>";
                                }
                                if($dsatz['r_day'] == 3)
                                {
                                echo "<td><select name='day' id='day'><option value='1' >Mo-Fr</option><option value='2' >Sa</option><option value='3' selected='selected'>So</option></select></td>";
                                }
                                echo "<td><input type='submit' class='lstbutton-login' value='Umlauf ändern'></form><form action='routeremovehandler.php' method='post'>
                                <input type='hidden' name='route_prim' value='" . $dsatz['r_prim'] . "'>
                                <input type='hidden' name='send' value='1337'>
                                <button type='submit' class='lstbutton-login-remove'>Umlauf löschen</button></td>";
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
                        <tr>
                          <form action='routehandler.php' method="post" enctype="multipart/form-data">
                          <td><input type="text" name="route_number" placeholder="Umlaufnummer" required></input></td>
                          <?php
                          include("mysql_config.php");
                          $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                          mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                          $res = mysqli_query($con, "SELECT * FROM `lst_maps`");
                          if(mysqli_num_rows($res) > 0)
                          {
                          echo "<td><select name='route_map'>";
                            while($dsatz = mysqli_fetch_assoc($res))
                            {
                              echo "<option value='" . $dsatz['m_name'] . "'>" . $dsatz['m_name'] . "</option>";
                            }
                          echo "</select></td>";
                          }
                          else {
                            echo "<td>Keine Karten verfügbar!</td>";
                          }
                          ?>
                          <td><input type="text" name="route_code" placeholder="Route Code" required></input></td>
                          <input type="hidden" name="send" value="1337" required>
                          <td><input type="text" name="route_card" placeholder='Direkter Download Link' required></input></td>
                            <?php
                            $res = mysqli_query($con, "SELECT * FROM `sys_dl_cat`");
                            if(mysqli_num_rows($res) > 0)
                            {
                              echo "<td><select name='route_dl_cat'>";
                              while($data = mysqli_fetch_assoc($res))
                              {
                                if($data['name'] != 'Allgemeines')
                                {
                                echo "<option value='" . $data['name'] . "'>" . $data['name_drop_menu'] . "</option>";
                                }
                              }
                              echo "</select></td>";
                            }
                            else
                            {
                              echo "<td>Keine Kategorien verfügbar!</td>";
                            }
                            mysqli_close($con);
                             ?>
                          <td><input type="text" name="dest_one" placeholder="1. Ziel der Linie" required></input></td>
                          <td><input type="text" name="dest_two" placeholder="2. Ziel der Linie" required></input></td>
                          <td><select name='day' id='day'><option value='1'>Mo-Fr</option><option value='2'>Sa</option><option value='3'>So</option></select></td>
                          <td><button class="lstbutton-login" type="submit">Umlauf hinzufügen</button>  <input class="lstbutton-login-remove" type="reset"></input></td></form>
                        </tr>
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
