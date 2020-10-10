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
        <title>Nutzerübersicht | LOTUS-Leitstelle</title>
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
                <header class="content-header">Nutzer Übersicht</header>
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
                            <th>Nutzername</th>
                            <th>Rang</th>
                            <th>Status</th>
                            <th>Zuletzt Online</th>
                            <th>Optionen</th>
                        </tr>
                        <?php
                        include("mysql_config.php");
                        $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                        mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                        $res = mysqli_query($con, "SELECT `u_nickname`, `u_rechte`, `date_last`, `status` FROM `sys_user`");
                        if(mysqli_num_rows($res) > 0)
                        {
                        while($dsatz = mysqli_fetch_assoc($res))
                        {
                          echo "<tr>";
                          echo "<td>" . $dsatz['u_nickname'] . "</td>";
                          if($dsatz['u_rechte'] == 1)
                          {
                            echo "<td>Nutzer</td>";
                          }
                          if($dsatz['u_rechte'] == 2)
                          {
                            echo "<td>Moderator</td>";
                          }
                          if($dsatz['u_rechte'] == 3)
                          {
                            echo "<td>Admin</td>";
                          }

                          if($dsatz['status'] == 0)
                          {
                            echo "<td>Offline</td>";
                          }
                          else
                          {
                            echo "<td>Online</td>";
                          }
                          echo "<td>" . $dsatz['date_last'] . "</td>";
                          echo "<td>---</td>";
                          echo "</tr>";
                        }
                      }
                      else {
                        echo "<tr>";
                        echo "<td>Kein Nutzer registriert!</td>";
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
