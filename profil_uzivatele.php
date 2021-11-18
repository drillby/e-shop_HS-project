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
	$e_mail = $_SESSION["e_mail"];
	$jmeno = $_SESSION["jmeno"];
	$prijmeni = $_SESSION["prijmeni"];
	$heslo = $_SESSION["heslo"];
	if (isset($_SESSION["profil_err"]))
		$_SESSION["profil_err"] = "nic";

	if ($_SESSION["profil_err"] == "")
		$_SESSION["profil_err"] = "nic";

	if ($e_mail == "" || $jmeno == "" || $prijmeni == "" || $heslo == "") {
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		die();
	}
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
							<span>Změna údajů</span>
							<hr id="Indicator">
						</div>

						<?php
						echo "<form id=\"RegForm\" action=\"e-shop_zmena_udaju_uzivatel\" method=\"POST\">";
						if ($_SESSION["profil_err"] == "nevyplnene_udaje")
							echo "<h5>Nevyplnili jste všechny údaje!</h5>";
						if ($_SESSION["profil_err"] == "neshodne_heslo")
							echo "<h5>Zadané heslo se neshduje s vaším starým!</h5>";
						if ($_SESSION["profil_err"] == "jmeno_pismena")
							echo "<h5>Ve jméně mohou být pouze písmena!</h5>";
						if ($_SESSION["profil_err"] == "prijmeni_pismena")
							echo "<h5>V příjmení mohou být pouze písmena!</h5>";
						if ($_SESSION["profil_err"] == "e-mail_validace")
							echo "<h5>E-mail nesplňuje všechny požadavky!</h5>";
						if ($_SESSION["profil_err"] == "heslo_pozadavky")
							echo "<h5>Heslo nesplňuje všechny požadavky!</h5>";
						echo "<input type = \"text\" name = \"jmeno_nove\" value = \"$jmeno\">";
						echo "<input type = \"text\" name = \"prijmeni_nove\" value = \"$prijmeni\">";
						echo "<input type = \"text\" name = \"e_mail_novy\" value = \"$e_mail\">";
						echo "<input type = \"password\" name = \"heslo_nove\" value = \"$heslo\">";
						echo "<small class=\"stavajici_heslo\">Zadejte stávající heslo</small> <input type = \"password\" name = \"heslo_overeni\">";
						echo "<button type=\"submit\" class=\"btn\">Uložit údaje</button><br>";
						echo "<a href=\"odhlaseni.php\">Odhlásit se</a>";
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