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
        <title>Systemeinstellungen | LOTUS-Leitstelle</title>
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
                <header class="content-header">Systemeinstellungen</header>
                <div class="content-main">
                  <?php
                  if($_GET['msg'] == 1)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Das Token " . $_GET['token'] . " wurde erfolgreich registriert!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 2)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Das Token konnte nicht registriert werden!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 3)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Das Token: " . $_GET['token'] . " wurde erfolgreich gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 4)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Das Token: " . $_GET['token'] . " konnte nicht gelöscht werden!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 5)
                  {
                    echo "<div class='info-box-info'>";
                        echo "<div class='info'>Info! Das Formular bitte nicht manipulieren!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 6)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Der Fahrzeugtyp " . $_GET['type'] . " wurde erfolgreich hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 7)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Der Fahrzeugtyp " . $_GET['type'] . " wurde nicht hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 8)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Der Fahrzeugtyp " . $_GET['type'] . " und alle angemeldeten Fahrzeuge wurden erfolgreich entfernt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 9)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Der Fahrzeugtyp " . $_GET['type'] . " wurde nicht entfernt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 10)
                  {
                    echo "<div class='info-box-info'>";
                      echo "<div class='info'>Info! Fehler bei der Auswahl des anzuwendenden Handlers! Kontaktieren sie einen Administrator!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 11)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Die Download Kategorie: " . $_GET['cat'] . " wurde erfolgreich gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 12)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Download Kategorie wurde nicht gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 13)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Der Fahrzeugetyp: " . $_GET['type'] . " wurde gelöscht, jedoch keines der angemeldeten Fahrzeuge!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 14)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Downloadkategorie wurde zwar gelöscht, jedoch keine der Kategorie zugeordneten Dateien!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 15)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Die Download Kategorie: " . $_GET['cat'] . " wurde erfolgreich hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 16)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Die Download Kategorie wurde nicht hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 17)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Das Ziel: " . $_GET['ziel'] . " wurde erfolgreich hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 18)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Das Ziel wurde nicht hinzugefügt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 19)
                  {
                    echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Das Ziel mit der ID:" . $_GET['id'] . " wurde erfolgreich entfernt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 20)
                  {
                    echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Das Ziel wurde nicht entfernt!</div>";
                    echo "</div>";
                  }

                  ?>
                  <div class="content-box">                                     <!---->
                  <div class="content-box-space-small">
                  </div>
                  <div class="content-box-space-small">
                  </div>                                                        <!-- Hier müssen dann noch Optionen eingebaut werden die Checkboxen haben!-->
                  <div class="content-box-space-small">
                  </div>
                  <div class="content-box-space-small">
                  </div>
                </div>                                                          <!---->
                  <h3>Tokenverwaltung</h3>
                    <div class="table">
                    <table id="sttable">
                        <tr>
                            <th>Token</th>
                            <th>Verwendet</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res = mysqli_query($con, "SELECT * FROM `sys_token`"); //Auswahl der Tabelle
                        while($dsatz = mysqli_fetch_assoc($res))
                        {
                          echo "<tr>";
                          echo "<td>" . $dsatz['l_token'] . "</td>";
                          if ($dsatz['used'] == 1)
                          {
                            echo "<td>Verwendet</td>";
                          }
                          else
                          {
                            echo "<td>Nicht Verwendet</td>";
                          }
                              echo "<td><form action='systemremovehandler.php' method='POST'>";                                           //Formular beginn
                              echo "<input type='hidden' name='token' value='" . $dsatz['l_token'] . "' required>";
                              echo "<input type='hidden' name='type' value='1'>";
                              echo "<input type='hidden' name='send' value='1337'>";
                              echo "<button class='lstbutton-login-remove' type='submit'>Token entfernen!</button>";      //Submit für das Formular
                              echo "</form></td>";
                              echo "</tr>";
                          }
                          ?>
                          <tr class='grey'>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          </tr>

                        <tr>
                          <?php
                          echo "<td>---</td>";
                          ?>
                          <td>---</td>
                          <form action="systemhandler.php" method="POST">
                          <input type="hidden" name="send" value="1337"></input>
                          <input type="hidden" name="type" value="1"></input>
                          <td><input type="submit" class="lstbutton-login" value="Token generieren"></input></td>
                        </form>
                        </tr>
                    </table>
                    <br>
                    <br>
                    </div>
                    <h3>Fahrzeugtypen</h3>
                    <div class="table">
                    <table id="sttable">
                        <tr>
                            <th>Fahrzeugtypen</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        $res = mysqli_query($con, "SELECT * FROM `sys_vehicle`"); //Auswahl der Tabelle
                        while($dsatz = mysqli_fetch_assoc($res))
                        {
                          echo "<tr>";
                          echo "<td>" . $dsatz['name'] . "</td>";
                              echo "<td><form action='systemremovehandler.php' method='POST'>";                                           //Formular beginn
                              echo "<input type='hidden' name='vehicle' value='" . $dsatz['name'] . "' required>";
                              echo "<input type='hidden' name='type' value='2'>";
                              echo "<input type='hidden' name='send' value='1337'>";
                              echo "<button class='lstbutton-login-remove' type='submit'>Typ entfernen!</button>";      //Submit für das Formular
                              echo "</form></td>";
                              echo "</tr>";
                          }
                          ?>
                          <tr class='grey'>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          </tr>

                        <tr>
                          <form action="systemhandler.php" method="POST">
                          <?php
                          echo "<td><input type='text' name='text_type' placeholder='Fahrzeugtyp' required></input></td>";
                          ?>
                          <input type="hidden" name="send" value="1337"></input>
                          <input type="hidden" name="type" value="2"></input>
                          <td><input type="submit" class="lstbutton-login" value="Hinzufügen"></input></td>
                        </form>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <h3>Download Kategorien</h3>
                    <div class="table">
                    <table id="sttable">
                        <tr>
                            <th>Download Kategorien</th>
                            <th>Name im Dropdown Menü</th>
                            <th>Name in der Tabelle</th>
                            <th>Beschreibung in der Tabelle</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        $res = mysqli_query($con, "SELECT * FROM `sys_dl_cat`"); //Auswahl der Tabelle
                        while($dsatz = mysqli_fetch_assoc($res))
                        {
                          echo "<tr>";
                          echo "<td>" . $dsatz['name'] . "</td>";
                          echo "<td>" . $dsatz['name_drop_menu'] . "</td>";
                          echo "<td>" . $dsatz['name_table'] . "</td>";
                          echo "<td>" . $dsatz['des_table'] . "</td>";
                              echo "<td><form action='systemremovehandler.php' method='POST'>";                                           //Formular beginn
                              echo "<input type='hidden' name='cat' value='" . $dsatz['name'] . "' required>";
                              echo "<input type='hidden' name='type' value='3'>";
                              echo "<input type='hidden' name='send' value='1337'>";
                              echo "<button class='lstbutton-login-remove' type='submit'>Kategorie entfernen!</button>";      //Submit für das Formular
                              echo "</form></td>";
                              echo "</tr>";
                          }
                          ?>
                          <tr class='grey'>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          </tr>

                        <tr>
                          <form action="systemhandler.php" method="POST">
                          <?php
                          echo "<td><input type='text' name='cat_text' placeholder='Name der Kategorie' require></input></td>";
                          echo "<td><input type='text' name='cat_drop' placeholder='Name im Dropdownmenü' require></input></td>";
                          echo "<td><input type='text' name='cat_table' placeholder='Name in der Tabelle' require></input></td>";
                          echo "<td><input type='text' name='cat_des' placeholder='Beschreibung in der Tabelle' require></input></td>";
                          ?>
                          <input type="hidden" name="send" value="1337"></input>
                          <input type="hidden" name="type" value="3"></input>
                          <td><input type="submit" class="lstbutton-login" value="Hinzufügen"></input></td>
                        </form>
                        </tr>
                    </table>
                    <br>
                    <br>
                    </div>
                    <h3>Einstellbare Ziele</h3>
                    <div class="table">
                    <table id="sttable">
                        <tr>
                            <th>Ziel</th>
                            <th>Map</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        $res = mysqli_query($con, "SELECT * FROM `sys_dest`"); //Auswahl der Tabelle
                        while($dsatz = mysqli_fetch_assoc($res))
                        {
                          echo "<tr>";
                          echo "<td>" . $dsatz['dest'] . "</td>";
                          echo "<td>" . $dsatz['map'] . "</td>";
                              echo "<td><form action='systemremovehandler.php' method='POST'>";                                           //Formular beginn
                              echo "<input type='hidden' name='id' value='" . $dsatz['prim'] . "'>";
                              echo "<input type='hidden' name='type' value='4'>";
                              echo "<input type='hidden' name='send' value='1337'>";
                              echo "<button class='lstbutton-login-remove' type='submit'>Ziel entfernen!</button>";      //Submit für das Formular
                              echo "</form></td>";
                              echo "</tr>";
                          }
                          ?>
                          <tr class='grey'>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          <td class='grey'></td>
                          </tr>

                        <tr>
                          <form action="systemhandler.php" method="POST">
                          <?php
                          echo "<td><input type='text' name='dest_name' placeholder='Name des Zieles' require></input></td>";
                          echo "<td><select name='dest_map'>";
                          $res = mysqli_query($con, "SELECT `m_name` FROM `lst_maps`");
                          while($dsatz = mysqli_fetch_assoc($res))
                          {
                            echo "<option value='" . $dsatz['m_name'] . "'>" . $dsatz['m_name'] . "</option>";
                          }
                          echo "</select></td>";
                          ?>
                          <input type="hidden" name="send" value="1337"></input>
                          <input type="hidden" name="type" value="4"></input>
                          <td><input type="submit" class="lstbutton-login" value="Hinzufügen"></input></td>
                        </form>
                        </tr>
                    </table>
                    <br>
                    <br>
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
