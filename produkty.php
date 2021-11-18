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
	$produkt_nazev = array();
	$produkt_druh = array();
	$produkt_cena = array();

	setlocale(LC_MONETARY, "cz_CZ.utf8");

	$servername = "dbs.spskladno.cz";
	$username = "student14";
	$password = "spsnet";
	$dbname = "vyuka14";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$penize_format = new NumberFormatter('ru_RU', NumberFormatter::CURRENCY);

	if (!$conn)
		die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

	$sql = "SELECT * FROM Produkt";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($produkt_nazev, $row["nazev_produkt"]);
			array_push($produkt_druh, $row["druh_produkt"]);
			$cena_echo = $penize_format->formatCurrency($row["cena_produkt"], 'CZK');
			array_push($produkt_cena, $cena_echo);
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

	<div class="small-container">
		<div class="row row-2">
			<h2>Všechny produkty</h2>
		</div>
		<div class="row">
			<div class="col-4">
				<a href="hp_notebook_detail.php"><img src="images/my_product-1.jpg"></a>
				<a href="hp_notebook_detail.php">
					<h4><?php echo "$produkt_nazev[0]"; ?></h4>
				</a>
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-o"></i>
				</div>
				<p><?php echo "$produkt_cena[0]"; ?></p>
			</div>
			<div class="col-4">
				<a href="samsung_note_20_detail.php"><img src="images/my_product-2.jpg"></a>
				<a href="samsung_note_20_detail.php">
					<h4><?php echo "$produkt_nazev[1]"; ?></h4>
				</a>
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-o"></i>
				</div>
				<p><?php echo "$produkt_cena[1]"; ?></p>
			</div>
			<div class="col-4">
				<a href="apple_watch_5_detail.php"><img src="images/my_product-3.jpg"></a>
				<a href="apple_watch_5_detail.php">
					<h4><?php echo "$produkt_nazev[2]"; ?></h4>
				</a>
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-o"></i>
				</div>
				<p><?php echo "$produkt_cena[2]"; ?></p>
			</div>
			<div class="col-4">
				<a href="samsung_810_L_detail.php"><img src="images/my_product-4.jpg"></a>
				<a href="samsung_810_L_detail.php">
					<h4><?php echo "$produkt_nazev[3]"; ?></h4>
				</a>
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
				</div>
				<p><?php echo "$produkt_cena[3]"; ?></p>
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

	<!-- js for toogle menu -->

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