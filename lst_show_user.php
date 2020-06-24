<?php
include("sessionssetter.php");

?>
<!DOCTYPE html>
<html lang="de">
    <head>
      <?php
      include("meta.php");
       ?>
        <title>Leitstellenfahrten | LOTUS-Leitstelle</title>
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
                <header class="content-header">Anstehende Leitstellenfahrten</header>
                <?php
                if($_GET['msg'] == 1)
                {
                  echo "<div class='info-box-sucess'>";
                      echo "<div class='sucess'>Erfolg! Erfolgreich angemeldet. Sobald du freigeschaltet wirst bekommst du eine Email.</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 2)
                {
                  echo "<div class='info-box-error'>";
                      echo "<div class='error'>Fehler! Du konntest leider nicht für die Leitstellenfahrt angemeldet werden!</div>";
                  echo "</div>";
                }
                if($_GET['msg'] == 3)
                {
                  echo "<div class='info-box-info'>";
                      echo "<div class='info'>Info! Das Formular bitte nicht manipulieren!</div>";
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
                            <th>Datum</th>
                            <th>Fahrzeuge</th>
                            <th>Karte</th>
                            <th>Leiter</th>
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
                            if($dsatz['lst_visible'] == 1)
                            {
                            echo "<tr>";
                            echo "<td>" . $dsatz['lst_name'] . "</td>";
                            echo "<td>" . $dsatz['lst_date'] . "</td>";
                            echo "<td>" . $dsatz['lst_fahrzeuge'] . "</td>";
                            echo "<td>" . $dsatz['lst_map'] . "</td>";
                            echo "<td>" . $dsatz['lst_admin'] . "</td>";
                            if($dsatz['lst_login_pb'] == 1)
                            {
                              $res_visible = mysqli_query($con, "SELECT * FROM `lst_login_fahrt` WHERE `l_user` = '" . $_SESSION['username'] . "'");
                              if(mysqli_num_rows($res_visible) == 0)
                              {
                              echo "<form action='lst_user_login.php' method='POST'>";
                              echo "<input type='hidden' name='lst_fahrt' value='" . $dsatz['lst_date'] . "'/>";
                              echo "<input type='hidden' name='send' value='1337'/>";
                              echo "<td><button class='lstbutton-login'>Anmelden</button></td>";
                              echo "</from>";
                              }
                              else {
                              echo "<form action='lstuserloginhandler.php' method='POST'>";
                              echo "<input type='hidden' name='lst_fahrt' value='" . $dsatz['lst_date'] . "'/>";
                              echo "<td><button class='lstbutton-login-remove'>Anmeldung löschung</button></td>";
                              echo "</from>";
                            }
                            }
                            else
                            {
                              echo "<td>Anmeldung noch nicht möglich!</td>";
                            }
                              echo "</tr>";
                            }
                          }
                        }
                        else
                        {
                          echo "<td>N/A</td>";
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
