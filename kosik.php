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
	/*
			tahle metoda vypisuje databázi Kosik, tzn. může bejt jenom jeden aktivní košík

			? nejspíš by to šlo udělat přes session, aby mohlo mít košík víc uživatelů zároveň
			ale to mi nešlo zprovoznit
			*/

	session_start();
	$_SESSION["objednavka_err"] = "nic";
	setlocale(LC_MONETARY, "us-US");

	$servername = "dbs.spskladno.cz";
	$username = "student14";
	$password = "spsnet";
	$dbname = "vyuka14";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn)
		die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

	$sql = "SELECT * FROM Kosik ORDER BY id_pordukt_kosik DESC";
	// řadí tak že se poslední produkt daný do košíku dá na konec
	$result = mysqli_query($conn, $sql);

	$nazvy = array();
	$kusy = array();
	$ceny = array();
	$suma = "Žádné produkty v košíku!";
	$odeber_cislo_tlacitka = 0;

	$penize_format = new NumberFormatter('ru_RU', NumberFormatter::CURRENCY);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($nazvy, $row["nazev_produkt_kosik"]);
			array_push($kusy, $row["mnozstvi_kosik"]);
			$cena_echo = $penize_format->formatCurrency($row["cena_produktu_kosik"], 'CZK');
			array_push($ceny, $cena_echo);
		}
	}

	$sql_suma = "SELECT mnozstvi_kosik, cena_produktu_kosik FROM Kosik";
	$result_suma = mysqli_query($conn, $sql_suma);

	if (mysqli_num_rows($result_suma) > 0) {
		$suma = 0;
		(int)$suma;
		while ($row = mysqli_fetch_assoc($result_suma)) {
			$mezivypocet = (int)$row["mnozstvi_kosik"] * (int)$row["cena_produktu_kosik"];
			$suma += $mezivypocet;
		}
	}


	if ($suma != 0) {
		$suma_echo = $penize_format->formatCurrency($suma, 'CZK');
	}
	$_SESSION["celkova_suma"] = $suma;

	$sql_pocet_radku = "SELECT COUNT(id_pordukt_kosik) AS \"radky\" FROM Kosik";
	$result_pocet_radku = mysqli_query($conn, $sql_pocet_radku);

	if (mysqli_num_rows($result_pocet_radku) > 0) {
		while ($row = mysqli_fetch_assoc($result_pocet_radku)) {
			$radky = (int)$row["radky"];
			$radky_echo = $radky;
		}
	}
	if ($suma == "Žádné produkty v košíku!")
		$suma_echo = $suma;

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

	<div class="small-container cart-page">
		<table>
			<tr>
				<th>Produkt</th>
				<th>Počet</th>
				<th>Cena za kus</th>
			</tr>
			<?php
			for ($radek = 0; $radek < $radky; $radek++) {
				echo "<tr>";
				$radky_echo -= 1;
				$odeber_cislo_tlacitka += 1;
				echo "<td>";
				echo "<div class='cart-info'>";
				echo "<div>";
				echo "<br>";
				echo "<p>$nazvy[$radky_echo]</p>";
				echo "<form action=\"odeber_produkt_script\" method=\"POST\">";
				echo "<button type=\"submit\" class=\"btn\" name=\"$odeber_cislo_tlacitka\" value=\"$odeber_cislo_tlacitka\">Odebrat</button>";
				echo "</form>";
				echo "</div>";
				echo "</div>";
				echo "</td>";
				echo "<td>$kusy[$radky_echo]</td>";
				echo "<td>$ceny[$radky_echo]</td>";
				echo "</tr>";
			}
			?>
		</table>
		<div class="total-price">
			<table>
				<tr>
					<td>Celková cena</td>
					<td><?php echo "$suma_echo"; ?></td>
				</tr>
				<?php
				if ($suma > 0) {
					echo "<tr>";
					echo "<td><a class=\"btn\" href=\"objednavka.php\">Potvrdit objednávku</a></td>";
					echo "</tr>";
				}
				?>
			</table>
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
</body>

</html>