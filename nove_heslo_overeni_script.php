<?php
session_start();
$kod = $_SESSION["kod"];
$heslo = $_SESSION["heslo"];
$e_mail_overeni = $_POST["e_mail_overeni"];
$e_mail_update = $_SESSION["e_mail_update"];

$_SESSION["nove_heslo_kod_err"] = "";

if ($kod != $e_mail_overeni) {
	$_SESSION["nove_heslo_kod_err"] = "nespravny_kod";
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/nove_heslo_script");
	die();
}

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn)
	die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

$sql = "UPDATE Zakaznik SET heslo_zakaznik='$heslo' WHERE email_zakaznik='$e_mail_update'";

mysqli_query($conn, $sql);
mysqli_close($conn);
echo "Váš email byl ověřen.<br>";
session_unset();
session_destroy();
header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/profil_uzivatele");
