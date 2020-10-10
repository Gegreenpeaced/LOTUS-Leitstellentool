<?php
require("downchecker.php");
require("sessionssetter_a.php");
?>
<!DOCTYPE html>
<html lang="de">
    <head>
      <?php
      include("meta.php");
       ?>
        <title>Leitstellenfahrten verwalten | LOTUS-Leitstelle</title>
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
        <script type="text/javascript">
        $( function() {
            $( "#datepicker" ).datepicker({
                inline: true,
    				    nextText: '&rarr;',
    				    prevText: '&larr;',
    				    showOtherMonths: true,
    				    dateFormat: 'dd. MM yy',
    				    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
        });
      });
      </script>
    </head>
    <body>
        <main class="app">
            <nav class="sidebar">
                <header class="sidebar-header">
                  <?php
                    require("navmenu.php");
                    require("footer.php");
                    ?>
            </nav>
            <nav class="space">
            </nav>
            <nav class="content">
                <header class="content-header">Leitstellenfahrten verwalten</header>
                <div class="content-main">
                  <?php
                  if($_GET['msg'] == 1)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Die Leitstellenfahrt: " . $_GET['name'] . " am " . $_GET['date'] . " wurde erfolgreich hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 2)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Leitstellenfahrt: " . $_GET['name'] . " am " . $_GET['date'] . " wurde nicht hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 3)
                  {
                    echo "<div class='info-box-info'>";
                      echo "<div class='info'>Info! Das Formular bitte nicht modellieren!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 4)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Die Anmeldung wurde erfolgreich freigeschaltet!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 5)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Anmeldung wurde nicht freigeschaltet!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 6)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Die Anmeldung wurde erfolgreich deaktiviert!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 7)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Anmeldung wurde nicht deaktiviert!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 8)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Die Leitstellenfahrt: " . $_GET['name'] . " am " . $_GET['date'] . " wurde erfolgreich gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 9)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Leitstellenfahrt: " . $_GET['name'] . " am " . $_GET['date'] . " wurde nicht gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 10)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Datum konnte nicht gesetzt werden!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 11)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Leitstellenfahrt wurde erfolgreich beendet!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 12)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Leitstellenfahrt konnte nicht beendet werden!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 13)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Leitstellenfahrt konnte nicht beendet werden!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 14)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Leitstellenfahrt konnte nicht beendet werden!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 15)
                  {
                    echo "<div class='info-box-info'>";
                      echo "<div class='info'>Info! Das Formular darf nicht manipuliert werden!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 16)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Leitstellenfahrt konnte nicht beendet werden!</div>";
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
                            <th>Datum</th>
                            <th>Karte</th>
                            <th>Fahrzeuge</th>
                            <th>Leiter</th>
                            <th>Anmeldung freigeschaltet</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res = mysqli_query($con, "SELECT * FROM `lst_fahrten`");
                        if(mysqli_num_rows($res) > 0)
                        {
                          while($dsatz = mysqli_fetch_assoc($res))
                            {
                            echo "<tr>";

                              echo "<td>" . $dsatz['lst_name'] . "</td>";
                              echo "<td>" . $dsatz['lst_date'] . "</td>";
                              echo "<td>" . $dsatz['lst_map'] . "</td>";
                              echo "<td>" . $dsatz['lst_fahrzeuge'] . "</td>";

                              echo "<td>" . $dsatz['lst_admin'] . "</td>";

                              if($dsatz['lst_login_pb'] == 1)
                              {
                                echo "<td>Anmeldung freigeschaltet!</td>";
                              }
                              else
                              {
                                echo "<td>Anmeldung noch nicht möglich!</td>";
                              }

                              echo "<td>";
                              if($dsatz['lst_u_login'] == 0)
                              {
                              if($dsatz['lst_login_pb'] == 0)
                              {
                                    echo "<form action='loginablehandler.php' method='POST'>";
                                    echo "<input type='hidden' name='date' value='" . $dsatz['lst_date'] . "'>";
                                    echo "<input type='hidden' name='lst_name' value='" . $dsatz['lst_name'] . "'>";
                                    echo "<input type='hidden' name='send' value='1337'>";
                                    echo "<button class='lstbutton-login'>Anmeldung freischalten!</button>";
                                    echo "</form>";
                              }
                              else
                              {
                                  echo "<form action='logindisablehandler.php' method='POST'>";
                                  echo "<input type='hidden' name='date' value='" . $dsatz['lst_date'] . "'>";
                                  echo "<input type='hidden' name='send' value='1337'>";
                                  echo "<button class='lstbutton-login'>Anmeldung deaktivieren!</button>";
                                  echo "</form>";

                                  echo "<form action='lst_admin_login_confirm.php'>";
                                  echo "<button class='lstbutton-login'>Anmeldungen verwalten!</button>";
                                  echo "</form>";

                                  echo "<form action='lststart.php' method='POST'>";
                                  echo "<input type='hidden' name='send' value='1337'>";
                                  echo "<input type='hidden' name='date' value='" . $dsatz['lst_date'] . "'>";
                                  echo "<button class='lstbutton-login'>Leitstellenfahrt starten!</button>";
                                  echo "</form>";
                              }

                                  echo "<form action='lstremovehandler.php' method='POST'>";
                                  echo "<input type='hidden' name='name' value='" . $dsatz['lst_name'] . "'>";
                                  echo "<input type='hidden' name='date' value='" . $dsatz['lst_date'] . "'>";
                                  echo "<input type='hidden' name='send' value='1337'>";
                                  echo "<button class='lstbutton-login-remove'>Fahrt löschen</button>";
                                  echo "</form>";
                                  echo "</td>";
                              }
                              else {
                                echo "<form action='lststop.php' method='POST'>";
                                echo "<input type='hidden' name='send' value='1337'>";
                                echo "<input type='hidden' name='date' value='" . $dsatz['lst_date'] . "'>";
                                echo "<button class='lstbutton-login'>Leitstellenfahrt beenden</button>";
                                echo "</form>";
                                echo "</td>";
                              }
                            echo "</tr>";
                          }
                            mysqli_close($con);
                          }
                          else {
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
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
                        </tr>
                        <?php
                        echo "<tr>";
                        echo "<form action='lsthandler.php' method='POST'>";
                        echo "<td><input type='text' name='lst_create_name' placeholder='Name' required/></td>";
                        echo "<td><input type='text' name='lst_create_date' placeholder='Datum' id='datepicker' required/></td>";

                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res_maps = mysqli_query($con, "SELECT * FROM `lst_maps`");
                        if(mysqli_num_rows($res_maps) > 0)
                        {
                          echo "<td><select name='lst_create_map'>";
                          while($dsatz_maps = mysqli_fetch_assoc($res_maps))
                          {
                            echo "<option value='" . $dsatz_maps['m_name'] . "'>" . $dsatz_maps['m_name'] . "</option>";
                          }
                          echo "</select></td>";
                        }
                        else {
                          echo "<td>Keine Karten gefunden</td>";
                        }

                        echo "<td><input type='text' name='lst_create_vehicles' placeholder='Fahrzeuge' required/></td>";

                        $res_user = mysqli_query($con, "SELECT `u_nickname`, `u_rechte` FROM `sys_user`");
                        if(mysqli_num_rows($res_user) > 0)
                        {
                          echo "<td><select name='lst_create_leader'>";
                          while($dsatz_user = mysqli_fetch_assoc($res_user))
                          {
                            if($dsatz_user['u_rechte'] > 1)
                            {
                            echo "<option value='" . $dsatz_user['u_nickname'] . "'>" . $dsatz_user['u_nickname'] . "</option>";
                            }
                            else {
                              echo "Keine Administratoren gefunden!";
                            }
                          }
                          echo "</td>";
                        }
                        else {
                          echo "<td>Keine passenden Leiter gefunden!</td>";
                        }

                        mysqli_close($con);

                        echo "<td><select name='lst_u_login'><option value='1'>Ja</option><option value='0' selected='selected'>Nein</option></select></td>";

                         ?>
                        </td>
                        <input type="hidden" name="send" value="1337">
                        <td><input class="lstbutton-login" type="submit" value="Fahrt erstellen">  <input class="lstbutton-login-remove" type="reset" value="Zurücksetzten"></td></tr></form>
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
