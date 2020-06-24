<?php
include("sessionssetter.php");
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
        include("meta.php");
        ?>
        <title>Dashboard | LOTUS-Leitstelle</title>
    </head>
        <?php
        if($_SESSION['dark'] == 1){
        echo "<body class='dark-theme'>";
        }
        else{
        echo "<body>";
        }?>
          <main class='app'>
            <nav class="sidebar">
                <header class="sidebar-header">
                  <?php
                    include("navmenu.php");
                    include("footer.php");
                    ?>
            </nav>
            </div>
            <?php
            if($_SESSION['dark'] == 1){                //---
              echo "<nav class='space-dark'>";
              echo "</nav>";                           //Linkes NAV Stück
            }
            else{
              echo "<nav class='space'>";
              echo "</nav>";                            //---
            }?>
            <?php                                       //---
            if($_SESSION['dark'] == 1){
              echo "<nav class='content-dark'>";        //Mittleres NAV Stück
            }
            else{
              echo "<nav class='content'>";             //---
            }?>
            <?php
            if($_SESSION['dark'] == 1){                                         //---
              echo "<header class='content-header-dark'>Dashboard</header>";
            }                                                                   //Header Stück
            else{
              echo "<header class='content-header'>Dashboard</header>";         //---
            }?>
                <div class="content-main">
                  <?php
                  /*/
                  include("mysql_config.php");
                  $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
                  mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
                  $sql = "SELECT * FROM system WHERE 1";
                  $res = mysqli_query($con, $sql); //Auswahl der Tabelle                                                  IMPROVE!!!!
                  $dsatz = mysqli_fetch_assoc($res);
                  echo $dsatz;
                  if($dsatz['notam'] > 0)
                  {
                    echo "<div class='info-box-info'>";
                        echo "<div class='sucess'>Es gibt eine neue NOTAM Nachricht!</div>";
                    echo "</div>";
                  }/*/
                    ?>
                    <?php
                    if($_GET['l'] == 1)
                    {
                    echo "<div class='info-box-sucess'>";
                        echo "<div class='sucess'>Sie wurden erfolgreich als " . $_SESSION['username'] . " angemeldet! </div>";
                    echo "</div>";
                    }
                    ?>
                    <?php
                    if($_SESSION['dark'] == 1)
                    {
                    echo "<div class='content-box-dark'>";
                      echo "<div class='content-box-space-small-dark'>";
                      echo "</div>";
                      echo "<div class='content-box-space-small-dark'>";
                      echo "</div>";
                      echo "<div class='content-box-space-small-dark'>";
                      echo "</div>";
                      echo "<div class='content-box-space-small-dark'>";
                      echo "</div>";
                    echo "</div>";
                    }
                    else {
                    echo "<div class='content-box'>";
                      echo "<div class='content-box-space-small'>";
                      echo "</div>";
                      echo "<div class='content-box-space-small'>";
                      echo "</div>";
                      echo "<div class='content-box-space-small'>";
                      echo "</div>";
                      echo "<div class='content-box-space-small'>";
                      echo "</div>";
                    echo "</div>";
                    }
                    ?>
                    <div class="content-box">
                    <div class="content-box-nospace">
                        <div class=
                        <?php
                        if($_SESSION['dark'] == 1)
                        {
                        echo "'content-box-text-dark'";
                        }
                        else {
                          echo "'content-box-text'";
                        }
                        ?>>

                            <h1 class=
                            <?php
                            if($_SESSION['dark'] == 1)
                            {
                            echo "'content-box-text-h1-dark'";
                            }
                            else {
                              echo "'content-box-text-h1'";
                            }
                            ?>>Wichtige Informationen</h1>

                            <h2 class=
                            <?php
                            if($_SESSION['dark'] == 1)
                            {
                            echo "'content-box-text-h2-dark'";
                            }
                            else {
                              echo "'content-box-text-h2'";
                            }
                            ?>>Nächste Leitstellenfahrt am:
                            <?php
                            include("mysql_config.php");
                            $con = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS); //Datenbank Connection
                            mysqli_select_db($con, $MYSQL_DB); //Auswahl der Datenbank
                            $sql = "SELECT * FROM `system` WHERE 1";
                            $res = mysqli_query($con, $sql); //Auswahl der Tabelle
                            $dsatz = mysqli_fetch_assoc($res);
                            echo $dsatz['lst_next_date'];
                            ?>
                            </h2> <!--Hier müsste jetzt eine Datenbankabfrage rein-->
                        </div>
                    </div>
                    <?php
                    if($_SESSION['dark'] == 1)
                    {
                    echo "<div class='content-box-space-dark'>";
                    echo "</div>";
                    echo "<div class='content-box-space-dark'>";
                    echo "</div>";
                    }
                    else
                    {
                    echo "<div class='content-box-space'>";
                    echo "</div>";
                    echo "<div class='content-box-space'>";
                    echo "</div>";
                    }
                    ?>
                    <div class="content-box-nospace">
                        <div class="content-box-text">
                            <h1 class="content-box-text-h1">Konto Informationen</h1>
                            <?php
                            echo "<h2 class='content-box-text-h2'>Eingeloggt als: " . $_SESSION['username'] . " </h2>";
                            echo "<h2 class='content-box-text-h2'>Accounttyp: ";
                            if($_SESSION['rechte'] == 1)
                            {
                              echo "Nutzer";
                            }
                            if($_SESSION['rechte'] == 2)
                            {
                              echo "Moderator";
                            }
                            if($_SESSION['rechte'] == 3)
                            {
                              echo "Administrator";
                            }
                            "</h2>";
                            ?>
                        </div>
                    </div>
                  </div>
                </div>
            </nav>
            <?php
            if($_SESSION['dark'] == 1){                //---
              echo "<nav class='logout-bar-dark'>";
              echo "&nbsp;";
              echo "</nav>";                           //Rechtes NAV Stück
            }
            else{
              echo "<nav class='logout-bar'>";
              echo "&nbsp;";
              echo "</nav>";                            //---
            }?>
            <br>
        </main>
    </body>
</html>
