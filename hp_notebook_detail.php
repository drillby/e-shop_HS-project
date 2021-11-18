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
	if (!isset($_SESSION["pocet_produktu_hpnotebook_err"]))
		$_SESSION["pocet_produktu_hpnotebook_err"] = "nic";

	$servername = "dbs.spskladno.cz";
	$username = "student14";
	$password = "spsnet";
	$dbname = "vyuka14";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn)
		die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

	$sql = "SELECT * FROM Produkt WHERE id_produkt = 1";
	$result = mysqli_query($conn, $sql);

	$penize_format = new NumberFormatter('ru_RU', NumberFormatter::CURRENCY);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$produkt_nazev = $row["nazev_produkt"];
			$produkt_druh = $row["druh_produkt"];
			$produkt_cena = $penize_format->formatCurrency($row["cena_produkt"], 'CZK');
		}
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

	<div class="small-container single-product">
		<div class="row">
			<div class="col-2">
				<img src="images/my_gallery-1.jpg" width="100%" id="ProductImg">

				<div class="small-img-row">
					<div class="small-img-col">
						<img src="images/my_gallery-1.jpg" width="100%" class="small-img">
					</div>
					<div class="small-img-col">
						<img src="images/my_gallery-2.jpg" width="100%" class="small-img">
					</div>
					<div class="small-img-col">
						<img src="images/my_gallery-3.jpg" width="100%" class="small-img">
					</div>
					<div class="small-img-col">
						<img src="images/my_gallery-4.jpg" width="100%" class="small-img">
					</div>
				</div>

			</div>
			<div class="col-2">
				<p class="kategorie"><?php echo "$produkt_druh"; ?></p>
				<h1 class="jmeno_produkt"><?php echo "$produkt_nazev"; ?></h1>
				<h4><?php echo "$produkt_cena"; ?></h4>
				<form action="e-shop_pridat_do_kosiku_script" method="POST">
					<input type="number" name="kolik" value="1" min="1" max="9">
					<?php
					if ($_SESSION["pocet_produktu_hpnotebook_err"] == "true")
						echo "<h5 style = \"color: white\">Zadejte hodnotu v rozsahu!</h5>";
					?>
					<button href="e-shop_pridat_do_kosiku_script" class="btn" type="submit">Přidat Do Košíku</button>
				</form>
				<h3 class="popis_nadpis">Detaily produktu <i class="fa fa-indent"></i></h3>
				<br>
				<p class="popis">Pod názvem HP 15s-du1034tu se skrývá patnáctipalcový notebook, na který se můžete kdykoliv stoprocentně spolehnout. Jedná se totiž o sympatický přístroj, který vám může nabídnout stabilní hardwarové zázemí, bezpečný operační systém i celou řadu praktických funkcí, technologií a konektorů. Ať už se tak hodláte celý den věnovat práci, anebo máte v plánu odpočinek s filmy, oddechovými hrami či muzikou, tento laptop je vám k službám.
					Spolehlivý výkon vám při práci s kancelářskými aplikacemi, multimédii i webovými službami zajistí dvoujádrový procesor AMD Athlon 3050U ve spolupráci s pamětí 8 GB RAM, integrovanou grafickou kartou AMD Radeon a rychlým SSD úložištěm o kapacitě 512 GB, 1 TB, nebo 2 TB.</p><br>
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

	<script>
		var ProductImg = document.getElementById("ProductImg");
		var SmallImg = document.getElementsByClassName("small-img");

		SmallImg[0].onclick = function() {
			ProductImg.src = SmallImg[0].src;
		}

		SmallImg[1].onclick = function() {
			ProductImg.src = SmallImg[1].src;
		}

		SmallImg[2].onclick = function() {
			ProductImg.src = SmallImg[2].src;
		}

		SmallImg[3].onclick = function() {
			ProductImg.src = SmallImg[3].src;
		}
	</script>

</body>

</html>