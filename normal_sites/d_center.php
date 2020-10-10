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
        <title>Download Center | LOTUS-Leitstelle</title>
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
                <header class="content-header">Download Center</header>
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
                    <?php
                    include("mysql_config.php");
                    $con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
                    mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
                    $sql_h_title = "SELECT * FROM `sys_dl_cat`";
                    $res_h_title = mysqli_query($con, $sql_h_title);
                    $num_h_title = mysqli_affected_rows($con);
                    if($num_h_title > 0)
                    {
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
                            echo "<td><a class='lstbutton-login-a' href='" . $data_table_content['link'] . "'> Download </a></td>";
                           }
                        }

                        echo "</table>";
                        echo "</div>";
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                      }
                    }
                    else {
                      echo "<h3>Keine Kategorien Verfügbar</h3>";
                      echo "<div class='table'>";
                      echo "<table id='sttable'>";
                        echo "<tr>";
                          echo "<th>N/A</th>";
                          echo "<th>N/A</th>";
                          echo "<th>N/A</th>";
                          echo "<th>N/A</th>";
                        echo "</tr>";

                        echo "<tr>";
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                          echo "<td>N/A</td>";
                        echo "</tr>";
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
