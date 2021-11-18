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
	if ($_SESSION["objednavka_err"] == "")
		$_SESSION["objednavka_err"] = "nic";

	if (isset($_SESSION["e_mail"]))
		$e_mail = $_SESSION["e_mail"];

	if (isset($_SESSION["jmeno"]))
		$jmeno = $_SESSION["jmeno"];

	if (isset($_SESSION["prijmeni"]))
		$prijmeni = $_SESSION["prijmeni"];

	else {
		$e_mail = "";
		$jmeno = "";
		$prijmeni = "";
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
					<div class="form-container-dodani">
						<div class="form-btn">
							<span>Vyberte adresu doručení</span>
							<hr id="Indicator">
						</div>
						<form id="RegForm" action="objednavka_zpracovani.php" method="POST">
							<?php
							if ($_SESSION["objednavka_err"] == "nevyplnene_udaje")
								echo "<h5>Vyplňte všechny položky</h5>";

							if ($_SESSION["objednavka_err"] == "jmeno_pismena")
								echo "<h5>Ve jméně mohou být pouze písmena</h5>";

							if ($_SESSION["objednavka_err"] == "prijmeni_pismena")
								echo "<h5>V příjmení mohou být pouze písmena</h5>";

							if ($_SESSION["objednavka_err"] == "nespravny_telefon")
								echo "<h5>Telefoní číslo nemá správnou formu</h5>";

							if ($_SESSION["objednavka_err"] == "email_validace")
								echo "<h5>E-mail nemá správnou formu</h5>";
							if ($_SESSION["objednavka_err"] == "psc_neni_cislo")
								echo "<h5>PSČ musí obsahovat pouze čisla</h5>";

							if ($e_mail == "" || $jmeno == "" || $prijmeni == "") {
								echo "<input type=\"text\" name=\"jmeno_order\" placeholder=\"Zadejte jméno\">";
								echo "<input type=\"text\" name=\"prijmeni_order\" placeholder=\"Zadejte příjmení\">";
								echo "<input type=\"text\" name=\"e_mail_order\" placeholder=\"Zadejte E-mail\">";
								echo "<div class=\"tooltip\">";
								echo "<input type=\"text\" name=\"telefon_order\" placeholder=\"Zadejte telefon\">";
								echo "<span class=\"tooltiptext\">Číslo zadejte bez předčíslí</span>";
								echo "</div>";
								echo "<input type=\"text\" name=\"ulice_a_cp_order\" placeholder=\"Zadejte ulici a č. p.\">";
								echo "<input type=\"text\" name=\"mesto_order\" placeholder=\"Zadejte město\">";
								echo "<input type=\"text\" name=\"psc_order\" placeholder=\"Zadejte PSČ\">";
							} else {
								echo "<input type=\"text\" name=\"jmeno_order\" value = \"$jmeno\">";
								echo "<input type=\"text\" name=\"prijmeni_order\" value = \"$prijmeni\">";
								echo "<input type=\"text\" name=\"e_mail_order\" value = \"$e_mail\">";
								echo "<div class=\"tooltip\">";
								echo "<input type=\"text\" name=\"telefon_order\" placeholder=\"Zadejte telefon\">";
								echo "<span class=\"tooltiptext\">Číslo zadejte bez předčíslí</span>";
								echo "<input type=\"text\" name=\"ulice_a_cp_order\" placeholder=\"Zadejte ulici a č. p.\">";
								echo "<input type=\"text\" name=\"mesto_order\" placeholder=\"Zadejte město\">";
								echo "<input type=\"text\" name=\"psc_order\" placeholder=\"Zadejte PSČ\">";
							} ?>
							<h5>Vyberte stát</h5>
							<select name="stat_order">
								<option value="cesko">Česká Republika</option>
								<option value="slovensko">Slovenská Republika</option>
							</select>
							<!-- udělat dropdown -->
							<input type="submit" class="btn" value="Ověřit adresu na mapě" name="overit_adresu">
							<input type="submit" class="btn" value="Zpracovat" name="zpracovat">
						</form>
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