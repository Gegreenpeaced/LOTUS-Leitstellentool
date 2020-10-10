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
        <title>Download Center Administration | LOTUS-Leitstelle</title>
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
                <header class="content-header">Download Center Administration</header>
                <div class="content-main">
                    <?php
                    if($_GET['msg'] == 1)
                    {
                      echo "<div class='info-box-sucess'>";
                          echo "<div class='sucess'>Erfolg! Der Gegenstand: " . $_GET['name'] . " wurde dem Download Center in der Kategorie: " . $_GET['cat'] . " erfolgreich hinzugefügt!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 2)
                    {
                      echo "<div class='info-box-error'>";
                          echo "<div class='error'>Fehler! Der Gegenstand: " . $_GET['name'] . " wurde dem Download Center nicht hinzugefügt!</div>";
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
                        echo "<div class='sucess'>Erfolg! Der Gegenstand mit der ID: " . $_GET['id'] . " wurde erfolgreich gelöscht!</div>";
                      echo "</div>";
                    }
                    if($_GET['msg'] == 5)
                    {
                      echo "<div class='info-box-error'>";
                        echo "<div class='error'>Fehler! Der Gegenstand mit der ID: " . $_GET['id'] . " wurde nicht gelöscht!</div>";
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
                    <h3>Upload</h3>
                    <div class="table">
                    <table id="sttable">
                      <tr>
                        <th>Kategorie</th>
                        <th>Name</th>
                        <th>Upload - Datum</th>
                        <th>Beschreibung</th>
                        <th>Datei</th>
                        <th>Optionen</th>
                      </tr>
                      <tr>
                        <form action="handler/dlcenterhandler.php" method="POST">
                          <?php
                          include("mysql_config.php");
                          $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                          mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                          $res = mysqli_query($con, "SELECT * FROM `sys_dl_cat`");
                          if(mysqli_num_rows($res) > 0)
                          {
                            echo "<td><select name='d_cat'>";
                            while($data = mysqli_fetch_assoc($res))
                            {
                              echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";
                            }
                            echo "</select></td>";
                          }
                          else
                          {
                            echo "<td>Keine Kategorien verfügbar!</td>";
                          }
                          echo "<td><input type='text' name='d_add_name' placeholder='Name' require></input></td>";
                          $date_field = date('l jS h:i:s, F Y');
                          echo "<td><input type='hidden' name='d_add_date' value='" . $date_field . "' require>" . $date_field . "</td>";
                          echo "<input type='hidden' name='send' value='1337'>";
                        ?>
                        <td><input type="text" name="d_descript" placeholder="Beschreibung" require></input></td>
                        <td><input type="text" name="d_file_link" placeholder="Direkter Download Link" require></input></td>
                        <td><input class="lstbutton-login" type="submit" value="Datei hinzufügen" require></input>  <input class="lstbutton-login-remove" type="reset"></input></td>
                      </form>
                      </tr>
                    </table>
                    </div>
                    <?php
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    $sql_h_title = "SELECT * FROM `sys_dl_cat`";
                    $res_h_title = mysqli_query($con, $sql_h_title);
                    $num_h_title = mysqli_affected_rows($con);

                    while($data_h_title = mysqli_fetch_assoc($res_h_title))
                      {
                        echo "<h3>" . $data_h_title['name'] . "</h3>";
                        echo "<div class='table'>";
                        echo "<table id='sttable'>";
                          echo "<tr>";
                            echo "<th>" . $data_h_title['name_table'] . "</th>";
                            echo "<th>Upload - Datum</th>";
                            echo "<th>Ziele / Beschreibung</th>";
                            echo "<th>Option</th>";
                          echo "</tr>";


                          $sql_table_content = "SELECT * FROM `dl_center`";
                          $res_table_content = mysqli_query($con, $sql_table_content);
                          $num_table_content = mysqli_affected_rows($con);

                        while($data_table_content = mysqli_fetch_assoc($res_table_content))
                        {
                          if($data_h_title['name'] == $data_table_content['cat'])
                          {
                          echo "<tr>";
                            echo "<td>" . $data_table_content['name'] . "</td>";
                            echo "<td>" . $data_table_content['date_t'] . "</td>";
                            echo "<td>" . $data_table_content['des'] . "</td>";
                            echo "<td>";
                            echo "<form action='handler/dcenterremovehandler.php' method='POST'>";
                            echo "<input type='hidden' name='send' value='1337'>";
                            echo "<input type='hidden' name='remove_name' value='" . $data_table_content['prim'] . "'>";
                            echo "<input class='lstbutton-login-remove' type='submit' value='Löschen'>";
                            echo "</form>";
                            echo "</td>";
                           }
                        }

                        echo "</table>";
                        echo "</div>";
                      }
                    ?>
                </div>
            </nav>
            <nav class="logout-bar">
                &nbsp;
            </nav>
            <br>
        </main>
    </body>
</html>
