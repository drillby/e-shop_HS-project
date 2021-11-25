<?php
/*
tahle metoda updatuje databázi Kosik, tzn. může bejt jenom jeden aktivní košík

? nejspíš by to šlo udělat přes session, aby mohlo mít košík víc uživatelů zároveň
to mi nešlo zprovoznit
*/

session_start();

$_SESSION["pocet_produktu_err"] = "";

if ($_POST == [])
	die("Script nelze volat přímo");

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn)
	die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

$kolik = $_POST["kolik"];

if ($kolik <= 0 || $kolik >= 9) {
	if (stristr($_SERVER["HTTP_REFERER"], "apple_watch_5_detail")) {
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/apple_watch_5_detail.php");
		$_SESSION["pocet_produktu_watch_err"] = "true";
	} else if (stristr($_SERVER["HTTP_REFERER"], "samsung_note_20_detail")) {
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/samsung_note_20_detail");
		$_SESSION["pocet_produktu_note20_err"] = "true";
	} else if (stristr($_SERVER["HTTP_REFERER"], "samsung_810_L_detail")) {
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/samsung_810_L_detail");
		$_SESSION["pocet_produktu_lednice_err"] = "true";
	} else if (stristr($_SERVER["HTTP_REFERER"], "hp_notebook_detail")) {
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/hp_notebook_detail");
		$_SESSION["pocet_produktu_hpnotebook_err"] = "true";
	}
	die();
}

if (stristr($_SERVER["HTTP_REFERER"], "hp_notebook_detail"))
// kontroluje z jaký stránky jsme přišli
{
	$sql = "SELECT * FROM Produkt WHERE id_produkt = 1";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$nazev_produktu = $row["nazev_produkt"];
			$cena_produktu = $row["cena_produkt"];
		}
	}
} else if (stristr($_SERVER["HTTP_REFERER"], "samsung_note_20_detail")) {
	$sql = "SELECT * FROM Produkt WHERE id_produkt = 2";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$nazev_produktu = $row["nazev_produkt"];
			$cena_produktu = $row["cena_produkt"];
		}
	}
} else if (stristr($_SERVER["HTTP_REFERER"], "apple_watch_5_detail")) {
	$sql = "SELECT * FROM Produkt WHERE id_produkt = 3";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$nazev_produktu = $row["nazev_produkt"];
			$cena_produktu = $row["cena_produkt"];
		}
	}
} else if (stristr($_SERVER["HTTP_REFERER"], "samsung_810_L_detail")) {
	$sql = "SELECT * FROM Produkt WHERE id_produkt = 4";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$nazev_produktu = $row["nazev_produkt"];
			$cena_produktu = $row["cena_produkt"];
		}
	}
}

$sql = "INSERT INTO Kosik (nazev_produkt_kosik, mnozstvi_kosik, cena_produktu_kosik) VALUES ('$nazev_produktu', $kolik, $cena_produktu)";

mysqli_query($conn, $sql);
mysqli_close($conn);

if (stristr($_SERVER["HTTP_REFERER"], "apple_watch_5_detail")) {
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/apple_watch_5_detail.php");
	$_SESSION["pocet_produktu_watch_err"] = "nic";
} else if (stristr($_SERVER["HTTP_REFERER"], "samsung_note_20_detail")) {
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/samsung_note_20_detail");
	$_SESSION["pocet_produktu_note20_err"] = "nic";
} else if (stristr($_SERVER["HTTP_REFERER"], "samsung_810_L_detail")) {
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/samsung_810_L_detail");
	$_SESSION["pocet_produktu_lednice_err"] = "nic";
} else if (stristr($_SERVER["HTTP_REFERER"], "hp_notebook_detail")) {
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/hp_notebook_detail");
	$_SESSION["pocet_produktu_hpnotebook_err"] = "nic";
}
