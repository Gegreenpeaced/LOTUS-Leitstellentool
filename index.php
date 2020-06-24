<html lang="de">
<head>
    <?php
    include("meta.php");
    ?>
    <?php
    //include("mysql_config.php");
    //$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
    //mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank                                        //    HIER MÜSSTE NEN DOWNMODE REIN!
    //$sql = "SELECT * FROM `system` WHERE 1";
    //$data = mysqli_query($con, $sql);
    ?>
  <title>Startseite | LOTUS - Leitstelle</title>
</head>
<boby>
  <main class="index">
    <header class="index-header"><img class="index-header-items" src="img/dash_logo.png"/></header>
    <nav class="index-main-content">
      <a class="index-links" href="impressum.php">Impressum</a>
      <a class="index-links" href="login.php">Login</a>
    </nav>
    <footer class="index-footer">
      <div class="index-footer-text">LOTUS - Leitstellentool<br>Copyright &copy by Julius Reiter
      </div>
    </footer>
  </main>
</body>
</html>
