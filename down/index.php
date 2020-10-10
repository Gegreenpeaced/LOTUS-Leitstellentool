<!DOCTYPE html>
<html lang="en">
<head>
	<title>We are Down! | LOTUS-Leitstelle</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../img/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<!--  -->
	<div class="simpleslide100">
		<div class="simpleslide100-item bg-img1" style="background-image: url('images/bg01.jpg');"></div>
		<div class="simpleslide100-item bg-img2" style="background-image: url('images/bg02.jpg');"></div>
	</div>

	<div class="flex-col-c-sb size1 overlay1">
		<!--  -->
		<div class="w-full flex-w flex-sb-m p-l-80 p-r-80 p-t-22 p-lr-15-sm">
			<div class="wrappic1 m-r-30 m-t-10 m-b-10">
				<a href="#"><img src="../img/dash_logo.png" alt="LOGO"></a>
			</div>
		</div>

		<!--  -->
		<div class="flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-120">
			<h3 class="l1-txt1 txt-center p-b-40 respon1">
				Wartungsarbeiten abgeschlossen am:
			</h3>
				<h3 class="l1-txt-date txt-center p-b-40 respon1">
					<?php
					require("../mysql_config_notlogin.php");
					$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
					mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
					$sql_version = "SELECT `down_fin` FROM `system` WHERE `prim`='1'";
					$res_version = mysqli_query($con, $sql_version);
					$data = mysqli_fetch_assoc($res_version);
					echo $data['down_fin'] . " Uhr";
					 ?>
				</h3>
		</div>

		<!--  -->
		<div class="flex-w flex-c-m p-b-35">
				&nbsp;
		</div>
	</div>





<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<!--<script src="vendor/countdowntime/moment.min.js"></script>
	<!--<script src="vendor/countdowntime/moment-timezone.min.js"></script>
	<!--<script src="vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<!--<script src="vendor/countdowntime/countdowntime.js"></script>



<?php

	//echo "<script>";
		//echo "$('.cd100').countdown100({";
			/*Set Endtime here*/
			/*Endtime must be > current time*/
		//echo "endtimeYear: 2020,";
		//echo "endtimeMonth: 0,";
		//echo "endtimeDate: 35,";
		//echo "endtimeHours: 19,";
		//echo "endtimeMinutes: 0,";
		//echo "endtimeSeconds: 0,";
			//echo "timeZone: 'Europe/Berlin'";
			/*/ ex:  timeZone: "America/New_York"
			go to " http://momentjs.com/timezone/ " to get timezone/*/
		//echo "})";
	//echo "</script>";

	?>-->
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
<footer class="index-footer">
	<div class="index-footer-text">LOTUS - Leitstellentool<br>Copyright &copy by Julius Reiter | Version <?php
	require("../mysql_config_notlogin.php");
	$con = mysqli_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS"); //Datenbank Connection
	mysqli_select_db($con, "$MYSQL_DB"); //Auswahl der Datenbank
	$sql_version = "SELECT `version` FROM `system` WHERE `prim`='1'";
	$res_version = mysqli_query($con, $sql_version);
	$data = mysqli_fetch_assoc($res_version);
	echo $data['version'];
	?> | <a href='../impressum.php'>Impressum</a>
	</div>
</footer>
</html>
