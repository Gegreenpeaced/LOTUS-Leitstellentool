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
        <title>Einstellungen | LOTUS-Leitstelle</title>
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
                <header class="content-header">Einstellungen</header>
                <div class="content-main">
                  <?php
                  if($_GET['msg'] == 1)
                  {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Erfolg! Die Einstellungen wurden erfolgreich geändert!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 2)
                  {
                    echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Die Einstellungen wurden nicht geändert!</div>";
                    echo "</div>";
                  }
                  if($_GET['msg'] == 3)
                  {
                    echo "<div class='info-box-info'>";
                        echo "<div class='info'>Das Formular darf nicht manipuliert werden!</div>";
                    echo "</div>";
                  }
                    ?>
                    <div class="content-box">
                        <form class="content-box-nospace-long" action="settingshandler.php" method="post">
                          <div class="content-box-text">
                            <h1 class="content-box-text-h1">Grafische Einstellungen</h1>
                            <?php
                            echo "<input type='hidden' name='username' value='" . $_SESSION['username'] . "'>";
                            echo "<input type='hidden' name='send' value='1337'>";
                            include("mysql_config.php");

                            $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
                            mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
                            $sql = "SELECT * FROM sys_user WHERE u_nickname='" . $_SESSION['username'] . "'";
                            $res = mysqli_query($con, $sql); //Auswahl der Tabelle
                            $dsatz = mysqli_fetch_assoc($res);
                            if($dsatz['darkth'] == 1)
                            {
                            echo "<h2 class='content-box-text-h2'><label class='content-box-text-h2'>Darkmode: <input type='checkbox' name='dark' checked='checked'></label></input></h2>";
                            echo "<h2 class='content-box-text-h2'>Optionen: <input class='submit-input-contentbox' type='submit' value='Ändern'> <input class='submit-input-contentbox' type='reset' value='Zurücksetzen'></h2>";
                            }
                            else {
                            echo "<h2 class='content-box-text-h2'><label class='content-box-text-h2'>Darkmode: <input type='checkbox' name='dark'></label></input></h2>";
                            echo "<h2 class='content-box-text-h2'>Optionen: <input class='submit-input-contentbox' type='submit' value='Ändern'> <input class='submit-input-contentbox' type='reset' value='Zurücksetzen'></h2>";
                            }
                            ?>
                          </div>
                        </form>
                    <div class="content-box-space">
                    </div>
                    <div class="content-box-space">
                    </div>
                    <form class="content-box-nospace-long" action="changepw.php" method="POST">
                        <div class="content-box-text">
                          <?php
                            echo "<h1 class='content-box-text-h1'>Konto Einstellungen</h1>";
                            include("mysql_config.php");

                            $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
                            mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
                            $sql = "SELECT * FROM sys_user WHERE u_nickname='" . $_SESSION['username'] . "'";
                            $res = mysqli_query($con, $sql);
                            if(mysqli_num_rows($res) > 0)
                            {
                              $dsatz = mysqli_fetch_assoc($res);
                              echo "<h2 class='content-box-text-h2'>Nutzername: " . $dsatz['u_nickname'] . "</h2>";
                              echo "<h2 class='content-box-text-h2'>Email: " . $dsatz['u_mail'] . "<input type='hidden' name='mail' value='" . $dsatz['u_mail'] . "'/></h2>";
                              echo "<h2 class='content-box-text-h2'>Accounttyp: ";
                              if($dsatz['u_rechte'] == 1)
                              {
                                echo "Nutzer";
                              }
                              if($dsatz['u_rechte'] == 2)
                              {
                                echo "Moderator";
                              }
                              if($dsatz['u_rechte'] == 3)
                              {
                                echo "Administrator";
                              }
                              echo "</h2>";

                            }
                            echo "<h2 class='content-box-text-h2'>Password: *************</h2>";
                            echo "<h2 class='content-box-text-h2'>Optionen: <input class='submit-input-contentbox' type='submit' value='Passwort ändern'> <input type='submit' class='submit-input-contentbox' value='Email ändern'></h2>";
                            ?>
                        </div>
                    </form>
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
