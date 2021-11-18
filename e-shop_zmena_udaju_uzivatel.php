<!DOCTYPE html>
<html>

<head>
	<title>Změna údajů</title>
</head>

<body>
	<?php
	session_start();
	$heslo = $_SESSION["heslo"];
	$e_mail = $_SESSION["e_mail"];

	$jmeno_nove = $_POST["jmeno_nove"];
	$prijmeni_nove = $_POST["prijmeni_nove"];
	$e_mail_novy = $_POST["e_mail_novy"];
	$heslo_nove = $_POST["heslo_nove"];
	$heslo_overeni = $_POST["heslo_overeni"];

	$_SESSION["profil_err"] = "";

	if ($jmeno_nove == "" || $prijmeni_nove == "" || $e_mail_novy == "" || $heslo_nove == "" || $heslo_overeni == "") {
		$_SESSION["profil_err"] = "nevyplnene_udaje";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele.php");
		die("Vyplňte všechna pole");
	}

	if ($heslo_overeni != $heslo) {
		$_SESSION["profil_err"] = "neshodne_heslo";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele.php");
		die("Zadané heslo pro ověření se neshoduje s vaším heslem.");
	}

	if (!ctype_alpha($jmeno_nove) == True && !preg_match('/[Ç-Ł]/', $jmeno_nove) && !preg_match("/[č-ę]/", $jmeno_nove) && !preg_match("/[ź-ş]/", $jmeno_nove) && !preg_match("/[Á-Ş]/", $jmeno_nove) && !preg_match("/[Ż-ż]/", $jmeno_nove) && !preg_match("/[Ă-ă]/", $jmeno_nove) && !preg_match("/[đ-ě]/", $jmeno_nove) && !preg_match("/[Ţ-Ů]/", $jmeno_nove) && !preg_match("/[Ó-ţ]/", $jmeno_nove) && !preg_match("/[ű-ř]/", $jmeno_nove)) {
		$_SESSION["profil_err"] = "jmeno_pismena";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele.php");
		die("Ve jméně mohou být pouze písmena");
	}

	if (!ctype_alpha($prijmeni_nove) == True && !preg_match('/[Ç-Ł]/', $prijmeni_nove) && !preg_match("/[č-ę]/", $prijmeni_nove) && !preg_match("/[ź-ş]/", $prijmeni_nove) && !preg_match("/[Á-Ş]/", $prijmeni_nove) && !preg_match("/[Ż-ż]/", $prijmeni_nove) && !preg_match("/[Ă-ă]/", $prijmeni_nove) && !preg_match("/[đ-ě]/", $prijmeni_nove) && !preg_match("/[Ţ-Ů]/", $prijmeni_nove) && !preg_match("/[Ó-ţ]/", $prijmeni_nove) && !preg_match("/[ű-ř]/", $prijmeni_nove)) {
		$_SESSION["profil_err"] = "prijmeni_pismena";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele.php");
		die("V příjmení mohou bejt pouze písmena");
	}

	$e_mail_novy = filter_var($_POST["e_mail_novy"], FILTER_SANITIZE_EMAIL);
	if (!filter_var($e_mail_novy, FILTER_VALIDATE_EMAIL)) {
		$_SESSION["profil_err"] = "e-mail_validace";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele.php");
		die("E-mailová adresa nespňuje všechny požadavky.");
	}

	if (strlen($heslo_nove) <= 5 || (preg_match('~[0-9]+~', $heslo_nove) == False) || preg_match('/[A-Z]/', $heslo_nove) == False || preg_match('/[a-z]/', $heslo_nove) == False) {
		$_SESSION["profil_err"] = "heslo_pozadavky";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele.php");
		die("Heslo musí obsahovat minimálně 6 znaků, jedno číslo, jedno malé a jedno velké písmeno.");
	}

	$heslo_nove = hash("sha256", $heslo_nove);

	$servername = "dbs.spskladno.cz";
	$username = "student14";
	$password = "spsnet";
	$dbname = "vyuka14";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn)
		die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

	$sql = "UPDATE Zakaznik SET jmeno_zakaznik = '$jmeno_nove', prijmeni_zakaznik = '$prijmeni_nove', email_zakaznik = '$e_mail_novy', heslo_zakaznik = '$heslo_nove' WHERE email_zakaznik = '$e_mail'";

	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);

	session_unset();
	session_destroy();

	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele.php");
	?>
</body>

</html>