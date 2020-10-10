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
        <title>Betriebskarten | LOTUS-Leitstelle</title>
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
                <header class="content-header">Betriebskarten</header>
                <div class="content-main">
                  <?php
                  if($_GET['change'] == 1)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Die Betriebskarte " . $_GET['map'] . " wurde hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['change'] == 2)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Die Betriebskarte " . $_GET['map'] . " wurde nicht hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['change'] == 3)
                  {
                    echo "<div class='info-box-info'>";
                        echo "<div class='info'>Das Manipulieren des Formulars ist nicht erlaubt!</div>";
                    echo "</div>";
                  }
                  if($_GET['change'] == 4)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Die Betriebskarte " . $_GET['map'] . " wurde gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['change'] == 5)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Die Betriebskarte " . $_GET['map'] . " wurde nicht gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['change'] == 6)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Die Parameter der Betriebskarte " . $_GET['map'] . " wurde geändert!</div>";
                    echo "</div>";
                  }
                  if($_GET['change'] == 7)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Die Parameter der Betriebskarte " . $_GET['map'] . " wurde nicht geändert!</div>";
                    echo "</div>";
                  }
                  if($_GET['change'] == 8)
                  {
                    echo "<div class='info-box-info'>";
                        echo "<div class='info'>Information! Die Parameter der Betriebskarte " . $_GET['map'] . " wurden ggf. nicht komplett geändert! Kontaktieren sie einen Administrator</div>";
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
                            <th>Name</th>
                            <th>Fahrzeugverwendungen</th>
                            <th>Karten-Typ</th>
                            <th>Spurweite</th>
                            <th>Haltestellenkonfiguration</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res = mysqli_query($con, "SELECT * FROM `lst_maps` WHERE 1");
                        if(mysqli_num_rows($res) > 0)
                        {
                          while($dsatz = mysqli_fetch_assoc($res))
                          {
                        echo "<tr>";
                        echo "<form action='handler/mapchangehandler.php' method='post'>";
                            echo "<td><input type='text' name='map_name_new' value='" . $dsatz['m_name'] . "'/></td>";
                            if($dsatz['m_vehicle'] == 1)
                            {
                            echo "<td><select name='map_vehicles' id='map_vehicles'><option value='1' selected='selected'>Bus</option><option value='2'>Tram</option><option value='3'>Tram + Bus</option></td>";
                            }
                            if($dsatz['m_vehicle'] == 2)
                            {
                            echo "<td><select name='map_vehicles' id='map_vehicles'><option value='1' selected>Bus</option><option value='2' selected='selected'>Tram</option><option value='3'>Tram + Bus</option></td>";
                            }
                            if($dsatz['m_vehicle'] == 3)
                            {
                            echo "<td><select name='map_vehicles' id='map_vehicles'><option value='1' selected>Bus</option><option value='2'>Tram</option><option value='3' selected='selected'>Tram + Bus</option></td>";
                            }


                            if($dsatz['m_typ'] == 1)
                            {
                              echo "<td><select name='map_type' id='map_type'><option value='1' selected='selected'>Stadt</option><option value='2'>Überland</option><option value='3'>Kleinstadt</option></td>";
                            }
                            if($dsatz['m_typ'] == 2)
                            {
                              echo "<td><select name='map_type' id='map_type'><option value='1'>Stadt</option><option value='2' selected='selected'>Überland</option><option value='3'>Kleinstadt</option></td>";
                            }
                            if($dsatz['m_typ'] == 3)
                            {
                              echo "<td><select name='map_type' id='map_type'><option value='1' >Stadt</option><option value='2'>Überland</option><option value='3' selected='selected'>Kleinstadt</option></td>";
                            }


                            if($dsatz['m_gauge'] == 1000)
                            {
                              echo "<td><select name='map_gauge' id='map_gauge'><option value='1435'>1435 Millimeter</option><option value='1000' selected='selected'>1000 Millimeter</option></td>";
                            }
                            if($dsatz['m_gauge'] == 1435)
                            {
                              echo "<td><select name='map_gauge' id='map_gauge'><option value='1435' selected='selected'>1435 Millimeter</option><option value='1000'>1000 Millimeter</option></td>";
                            }


                            if($dsatz['m_sconfig'] == 1)
                            {
                              echo "<td><select name='map_h_config' id='map_h_config'><option value='1' selected='selected'>Niederflur</option><option value='2'>Hochflur</option></td>";
                            }
                            if($dsatz['m_sconfig'] == 2)
                            {
                              echo "<td><select name='map_h_config' id='map_h_config'><option value='1'>Niederflur</option><option value='2' selected='selected'>Hochflur</option></td>";
                            }
                        echo "<input type='hidden' name='send' value='1337'/>";
                        echo "<input type='hidden' name='m_old_name' value='" . $dsatz['m_name'] . "'/>";
                        echo "<td><input type='submit' class='lstbutton-login' value='Änderungen übernehmen'></form>
                        </input><form action='handler/mapremovehandler.php' method='post'>
                        <input type='hidden' name='send' value='1337'/>
                        <input type='hidden' name='map_name_del' value='" . $dsatz['m_name'] . "'
                        ><input type='submit' class='lstbutton-login-remove' value='Karte löschen'</input>
                        </form>";
                        echo "</tr>";
                      }
                      }
                        ?>
                        <tr class="grey">
                          <td  class="grey"></td>
                          <td  class="grey"></td>
                          <td  class="grey"></td>
                          <td  class="grey"></td>
                          <td  class="grey"></td>
                          <td  class="grey"></td>
                        </tr>
                        <form action='handler/maphandler.php' method="post">
                        <tr>
                          <td><input type="text" name="map_name" required='required'/></td>
                          <input type="hidden" name="send" value="1337"></input>
                          <td><select name="map_vehicles" id="map_vehicles"><option value="1">Bus</option><option value="2">Tram</option><option value="3">Tram + Bus</option></select></td>
                          <td><select name="map_type" id="map_type"><option value="1">Stadt</option><option value="2">Überland</option><option value="3">Kleinstadt</option></select></td>
                          <td><select name="map_gauge" id="map_gauge"><option value="1435">1435 Millimeter</option><option value="1000">1000 Millimeter</option></select></td>
                          <td><select name="map_s_config" id="map_s_config"><option value="1">Niederflur</option><option value="2">Hochflur</option></select></td>
                          <td><input type="submit" class="lstbutton-login" value="Karte hinzufügen"></input><br><input type="reset" class="lstbutton-login-remove"/>
                        </tr>
                      </form>
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
