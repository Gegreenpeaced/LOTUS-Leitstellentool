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
        <title>Nutzer Administration | LOTUS-Leitstelle</title>
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
                <header class="content-header">Nutzer Administration</header>
                <div class="content-main">
                  <?php
                  if($_GET['msg'] == 1)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Der Nutzer " . $_GET['name'] . " mit der Email " . $_GET['mail'] . " wurde erfolgreich gelöscht!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 2)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Der Nutzer " . $_GET['name'] . " mit dem Email " . $_GET['mail'] . " wurde nicht gelöscht!</div>";
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
                        echo "<div class='sucess'>Erfolg! Die Rechte wurden auf " . $_GET['rechte'] . " geändert!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 5)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Die Rechte wurden nicht geändert!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 6)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Passwort wurde auf 123456 zurückgesetzt!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 7)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Passwort wurde nicht geändert! Möglicherweise wurde der Account beschädigt! Kontaktieren sie einen Admin!</div>";
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
                            <th>Vorname</th>
                            <th>Nachname</th>
                            <th>Nutzername</th>
                            <th>E-Mail</th>
                            <th>Rang</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res = mysqli_query($con, "SELECT `u_name`, `u_nachname`, `u_nickname`, `u_mail`, `u_rechte` FROM `sys_user`");
                        if(mysqli_num_rows($res) > 0)
                        {
                        while($dsatz = mysqli_fetch_assoc($res))
                        {
                            echo "<tr>";
                            echo "<form action='userchangerhandler.php' method='post'>";
                            echo "<td>" . $dsatz['u_name'] . "</td>";
                            echo "<td>" . $dsatz['u_nachname'] . "</td>";
                            echo "<td>" . $dsatz['u_nickname'] . "</td>";
                            echo "<td>" . $dsatz['u_mail'] . "</td>";
                            if($dsatz['u_mail'] != $_SESSION['mail'])
                            {
                            if($_SESSION['rechte'] == 2)
                              {
                                if($dsatz['u_rechte'] == 1)
                                  {
                                    echo "<td><select name='rechte' id='rechte'><option value='1' selected='selected'>User</option><option value='2'>Moderator</option></td>";
                                    echo "<input type='hidden' name='send' value='1337'/>";
                                    echo "<input type='hidden' name='mail' value='" . $dsatz['u_mail'] . "'/>";
                                    echo "<td><input type='submit' class='lstbutton-login' value='Änderungen übernehmen'></input></form>";
                                    echo "<form action='userpwreset.php' method='POST'>";
                                    echo "<input type='hidden' name='send' value='1337'>";
                                    echo "<input type='hidden' name='r_mail' value='" . $dsatz['u_mail'] . "'/>";
                                    echo "<input type='hidden' name='r_nickname' value='" . $dsatz['u_nickname'] . "'>";
                                    echo "<input class='lstbutton-login-remove' type='submit' value='Passwort zurücksetzen'></input></td>";
                                    echo "</form>";
                                    echo "</tr>";
                                  }
                                if($dsatz['u_rechte'] == 2)
                              {

                            echo "<td><select name='rechte' id='rechte'><option value='1'>User</option><option selected='selected' value='2'>Moderator</option></td>";
                            echo "<input type='hidden' name='send' value='1337'/>";
                            echo "<input type='hidden' name='mail' value='" . $dsatz['u_mail'] . "'/>";
                            echo "<td><input type='submit' class='lstbutton-login' value='Änderungen übernehmen'></input></form>";
                            echo "<form action='userpwreset.php' method='POST'>";
                            echo "<input type='hidden' name='send' value='1337'>";
                            echo "<input type='hidden' name='r_mail' value='" . $dsatz['u_mail'] . "'/>";
                            echo "<input type='hidden' name='r_nickname' value='" . $dsatz['u_nickname'] . "'>";
                            echo "<input class='lstbutton-login-remove' type='submit' value='Passwort zurücksetzen'></input></td>";
                            echo "</form>";
                            echo "</tr>";
                          }
                        if($dsatz['u_rechte'] == 3)
                          {
                            echo "<td>Admin</td>";
                            echo "<input type='hidden' name='send' value='1337'/>";
                            echo "<input type='hidden' name='mail' value='" . $dsatz['u_mail'] . "'/>";
                            echo "<td><button class='lstbutton-login'>Änderungen übernehmen</button></form>";
                            echo "<form action='userpwreset.php' method='POST'>";
                            echo "<input type='hidden' name='send' value='1337'>";
                            echo "<input type='hidden' name='r_mail' value='" . $dsatz['u_mail'] . "'/>";
                            echo "<input type='hidden' name='r_nickname' value='" . $dsatz['u_nickname'] . "'>";
                            echo "<input class='lstbutton-login-remove' type='submit' value='Passwort zurücksetzen'></input></td>";
                            echo "</form>";
                            echo "</tr>";
                          }
                        }
                          if($_SESSION['rechte'] == 3)
                          {
                            if($dsatz['u_rechte'] == 1)
                            {
                              echo "<td><select name='rechte' id='rechte'><option value='1' selected='selected'>User</option><option value='2'>Moderator</option><option value='3'>Admin</option></select></td>";
                            }
                            if($dsatz['u_rechte'] == 2)
                            {
                              echo "<td><select name='rechte' id='rechte'><option value='1'>User</option><option selected='selected' value='2'>Moderator</option><option value='3'>Admin</option></select></td>";
                            }
                            if($dsatz['u_rechte'] == 3)
                            {
                                echo "<td><select name='rechte' id='rechte'><option value='1'>User</option><option value='2'>Moderator</option><option value='3' selected='selected'>Admin</option></select></td>";
                            }
                          echo "<input type='hidden' name='send' value='1337'/>";
                          echo "<input type='hidden' name='mail' value='" . $dsatz['u_mail'] . "'/>";
                          echo "<td><input type='submit' class='lstbutton-login' value='Änderungen übernehmen'></input></form>";
                          echo "<form action='userremovehandler.php' method='POST'>";
                          echo "<input type='hidden' name='send' value='1337'/>";
                          echo "<input type='hidden' name='r_mail' value='" . $dsatz['u_mail'] . "'/>";
                          echo "<input type='hidden' name='r_nickname' value='" . $dsatz['u_nickname'] . "'>";
                          echo "<input class='lstbutton-login-remove' type='submit' value='Nutzer löschen'></input>";
                          echo "</form>";
                          echo "<form action='userpwreset.php' method='POST'>";
                          echo "<input type='hidden' name='send' value='1337'>";
                          echo "<input type='hidden' name='r_mail' value='" . $dsatz['u_mail'] . "'/>";
                          echo "<input type='hidden' name='r_nickname' value='" . $dsatz['u_nickname'] . "'>";
                          echo "<input class='lstbutton-login-remove' type='submit' value='Passwort zurücksetzen'></input></td>";
                          echo "</form>";
                          echo "</tr>";
                          }
                        }
                        else {
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                          echo "</tr>";
                        }
                      }
                      }
                      else {
                        echo "<tr>";
                        echo "<td>Kein Nutzer registriert!</td>";
                        echo "<td>---</td>";
                        echo "<td>---</td>";
                        echo "<td>---</td>";
                        echo "<td><button class='lstbutton-login-remove'>Nicht verfügbar</button></td>";
                        echo "</tr>";
                      }
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
