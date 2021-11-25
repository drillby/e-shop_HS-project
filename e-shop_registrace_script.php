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

	$jmeno = $_POST["jmeno"];
	$prijmeni = $_POST["prijmeni"];
	$e_mail = $_POST["e_mail"];
	$heslo = $_POST["heslo"];

	$_SESSION["jmeno"] = $jmeno;
	$_SESSION["prijmeni"] = $prijmeni;
	$_SESSION["e_mail"] = $e_mail;
	$_SESSION["heslo"] = $heslo;

	$_SESSION["registrace_err"] = "";

	if ($jmeno == "" || $prijmeni == "" || $e_mail == "" || $heslo == "") {
		$_SESSION["registrace_err"] = "nevyplnene_udaje";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		die("Vyplň všechna pole.");
	}

	if (!ctype_alpha($jmeno) == True && preg_match('/[Ç-Ł]/', $jmeno) == False && preg_match("/[č-ę]/", $jmeno) == False && preg_match("/[ź-ş]/", $jmeno) == False && preg_match("/[Á-Ş]/", $jmeno) == False && preg_match("/[Ż-ż]/", $jmeno) == False && preg_match("/[Ă-ă]/", $jmeno) == False && preg_match("/[đ-ě]/", $jmeno) == False && preg_match("/[Ţ-Ů]/", $jmeno) == False && preg_match("/[Ó-ţ]/", $jmeno) == False && preg_match("/[ű-ř]/", $jmeno) == False) {
		$_SESSION["registrace_err"] = "jmeno_pismena";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		die("Ve jméně mohou být pouze písmena");
	}
	// filtruje písmena základní ASCII a všechny písmena v latince (př. ě, ž, ń) přes rozšířenou ASCII

	if (!ctype_alpha($prijmeni) == True && preg_match('/[Ç-Ł]/', $prijmeni) == False && preg_match("/[č-ę]/", $prijmeni) == False && preg_match("/[ź-ş]/", $prijmeni) == False && preg_match("/[Á-Ş]/", $prijmeni) == False && preg_match("/[Ż-ż]/", $prijmeni) == False && preg_match("/[Ă-ă]/", $prijmeni) == False && preg_match("/[đ-ě]/", $prijmeni) == False && preg_match("/[Ţ-Ů]/", $prijmeni) == False && preg_match("/[Ó-ţ]/", $prijmeni) == False && preg_match("/[ű-ř]/", $prijmeni) == False) {
		$_SESSION["registrace_err"] = "prijmeni_pismena";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		die("V příjmení mohou být pouze písmena");
	}
	$e_mail = filter_var($_POST["e_mail"], FILTER_SANITIZE_EMAIL);
	if (!filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {
		$_SESSION["registrace_err"] = "email_validace";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		die("E-mailová adresa nespňuje všechny požadavky.");
	}
	// zvaliduje email. adresu, jestli má vše potřebné, z nějakýho důvodu nefunguje na seznam (gmail jo)

	if (strlen($heslo) <= 5 || (preg_match('~[0-9]+~', $heslo) == False) || preg_match('/[A-Z]/', $heslo) == False || preg_match('/[a-z]/', $heslo) == False) {
		$_SESSION["registrace_err"] = "heslo_pozdavky";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		die("Heslo musí obsahovat minimálně 6 znaků, jedno číslo, jedno malé a jedno velké písmeno.");
	}
	// kontroluje jestli zadané heslo splňuje požadavky

	$heslo = hash("sha256", $heslo);

	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn)
		die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

	$sql = "SELECT email_zakaznik FROM Zakaznik WHERE email_zakaznik = \"$e_mail\"";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$_SESSION["registrace_err"] = "email_registrovan";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		die("Tento e-mail je již registrován");
	}

	if (mysqli_num_rows($result) === 0) {
		$kod = mt_rand(1000, 9999);
		$_SESSION["kod"] = $kod;
	}

	$poslano = mail($e_mail, "Ověřovací kód", $kod);

	if ($poslano == False)
		die("Email se neposlal");
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
						echo "<form id=\"RegForm\" action=\"e-shop_email_verifikace\" method=\"POST\">";
						echo "<h5>Na váš email jsme zaslali ověřovací kód.</h5>";
						echo "<input type=\"text\" name=\"verify\" placeholder=\"Ověřovací kód\">";
						echo "<button type=\"submit\" class=\"btn\">Zpracovat</button>";
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