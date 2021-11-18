<!DOCTYPE html>
<html>

<head>
	<title>YellowStore</title>
</head>

<body>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>YellowStore</title>
		<link rel="shotcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
		<?php
		session_start();
		if ($_POST == [])
			die("Script nelze volat přímo");

		$email_kod = $_POST["verify"];
		$kod = $_SESSION["kod"];

		$jmeno = $_SESSION["jmeno"];
		$prijmeni = $_SESSION["prijmeni"];
		$e_mail = $_SESSION["e_mail"];
		$heslo = $_SESSION["heslo"];
		$heslo = hash("sha256", $heslo);

		if ($email_kod == $kod) {
			$servername = "dbs.spskladno.cz";
			$username = "student14";
			$password = "spsnet";
			$dbname = "vyuka14";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn)
				die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

			$sql = "INSERT INTO Zakaznik (jmeno_zakaznik, prijmeni_zakaznik, email_zakaznik, heslo_zakaznik) VALUES ('$jmeno', '$prijmeni', '$e_mail', '$heslo')";

			mysqli_query($conn, $sql);
			mysqli_close($conn);
			echo "Váš email byl ověřen.<br>";
		}
		session_unset();
		session_destroy();
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		?>
		<div class="container">
			<div class="navbar">
				<div class="logo">
					<a href="e-shop_hlavni_strana.php"><img src="images/logo.png" width="125px"></a>
				</div>
				<nav>
					<ul id="MenuItems">
						<li><a href="e-shop_hlavni_strana.php">Domů</a></li>
						<li><a href="produkty.php">Produkty</a></li>
						<li><a href="profil_uzivatele.php">Účet</a></li>
					</ul>
				</nav>
				<a href="kosik.php"><img src="images/cart.png" width="30px" height="30px"></a>
				<img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
			</div>
		</div>

		<div class="account-page">
			<div class="container">
				<div class="row">
					<div class="col-2">
						<img src="images/my_image1.jpg" width="100%">
					</div>
					<div class="col-2">
						<div class="form-container-zmena-udaju">
							<div class="form-btn">
								<span onclick="login()">Ověření e-mailu</span>
								<hr id="Indicator">
							</div>

							<?php
							echo "<form id=\"RegForm\" action=\"nove_heslo_overeni_script\" method=\"POST\">";
							echo "<h5>Zadali jste špatný kód. Zkuste to znovu.</h5>";
							echo "<input type=\"text\" name=\"e_mail_overeni\" placeholder=\"Ověřovací kód\">";
							echo "<button type=\"submit\" class=\"btn\">Uložit údaje</button>";
							echo "</form>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- footer -->

		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="footer-col-1">
						<h3>Stáhněte Si Naši Aplikaci</h3>
						<p>Stáhněte si aplikaci pro Android a iOS mobilní telefony.</p>
						<div class="app-logo">
							<img src="images/play-store.png">
							<img src="images/app-store.png">
						</div>
					</div>
					<div class="footer-col-2">
						<img src="images/logo-white.png">
						<p>Náš cíl a potěšení je dělat technoligie přístupnější.</p>
					</div>
					<div class="footer-col-3">
						<h3>Užitečné odkazy</h3>
						<ul>
							<li>Kupony</li>
							<li>Náš Blog</li>
							<li>Podmínky pro vrácení</li>
							<li>Affiliate odkaz</li>
						</ul>
					</div>
					<div class="footer-col-4">
						<h3>Sledujte nás</h3>
						<ul>
							<li>Facebook</li>
							<li>Twitter</li>
							<li>Instagram</li>
							<li>YouTube</li>
						</ul>
					</div>
				</div>
				<hr>
				<p class="copyright">CSS made by Easy Tutorials, modified by Pavel Podrazký</p>
			</div>
		</div>

		<script type="text/javascript">
			var MenuItems = document.getElementById("MenuItems");

			MenuItems.style.maxHeight = "0px";

			function menutoggle() {
				if (MenuItems.style.maxHeight == "0px") {
					MenuItems.style.maxHeight = "200px"
				} else {
					MenuItems.style.maxHeight = "0px"
				}
			}
		</script>

		<script type="text/javascript">
			var LoginForm = document.getElementById("LoginForm");
			var RegForm = document.getElementById("RegForm");
			var Indicator = document.getElementById("Indicator");

			function register() {
				RegForm.style.transform = "translateX(0px)";
				LoginForm.style.transform = "translateX(0px)";
				Indicator.style.transform = "translateX(100px)";
			}

			function login() {
				RegForm.style.transform = "translateX(300px)";
				LoginForm.style.transform = "translateX(300px)";
				Indicator.style.transform = "translateX(0px)";
			}
		</script>
	</body>

	</html>