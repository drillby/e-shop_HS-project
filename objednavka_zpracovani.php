<?php
if ($_POST == [])
	die("Script nelze volat přímo");

session_start();

$jmeno_order = $_POST["jmeno_order"];
$prijmeni_order = $_POST["prijmeni_order"];
$telefon_order = $_POST["telefon_order"];
$e_amil_order = $_POST["e_mail_order"];

$ulice_a_cp_order = $_POST["ulice_a_cp_order"];
$mesto_order = $_POST["mesto_order"];
$psc_order = $_POST["psc_order"];
$stat_order = $_POST["stat_order"];

if ($stat_order == "cesko")
	$stat_order = "Česká Republika";

if ($stat_order == "slovensko")
	$stat_order = "Slovenská Republika";

$_SESSION["jmeno_order"] = $jmeno_order;
$_SESSION["prijmeni_order"] = $prijmeni_order;
$_SESSION["telefon_order"] = $telefon_order;
$_SESSION["e_mail_order"] = $e_amil_order;

$_SESSION["ulice_a_cp_order"] = $ulice_a_cp_order;
$_SESSION["mesto_order"] = $mesto_order;
$_SESSION["psc_order"] = $psc_order;
$_SESSION["stat_order"] = $stat_order;

if ($jmeno_order == "" || $prijmeni_order == "" || $telefon_order == "" || $e_amil_order == "" || $ulice_a_cp_order == "" || $mesto_order == "" || $psc_order == "" || $stat_order == "") {
	$_SESSION["objednavka_err"] = "nevyplnene_udaje";
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/objednavka.php");
	die();
}

if (!ctype_alpha($jmeno_order) == True && !preg_match('/[Ç-Ł]/', $jmeno_order) && !preg_match("/[č-ę]/", $jmeno_order) && !preg_match("/[ź-ş]/", $jmeno_order) && !preg_match("/[Á-Ş]/", $jmeno_order) && !preg_match("/[Ż-ż]/", $jmeno_order) && !preg_match("/[Ă-ă]/", $jmeno_order) && !preg_match("/[đ-ě]/", $jmeno_order) && !preg_match("/[Ţ-Ů]/", $jmeno_order) && !preg_match("/[Ó-ţ]/", $jmeno_order) && !preg_match("/[ű-ř]/", $jmeno_order)) {
	$_SESSION["objednavka_err"] = "jmeno_pismena";
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/objednavka.php");
	die();
}

if (!ctype_alpha($prijmeni_order) == True && !preg_match('/[Ç-Ł]/', $prijmeni_order) && !preg_match("/[č-ę]/", $prijmeni_order) && !preg_match("/[ź-ş]/", $prijmeni_order) && !preg_match("/[Á-Ş]/", $prijmeni_order) && !preg_match("/[Ż-ż]/", $prijmeni_order) && !preg_match("/[Ă-ă]/", $prijmeni_order) && !preg_match("/[đ-ě]/", $prijmeni_order) && !preg_match("/[Ţ-Ů]/", $prijmeni_order) && !preg_match("/[Ó-ţ]/", $prijmeni_order) && !preg_match("/[ű-ř]/", $prijmeni_order)) {
	$_SESSION["objednavka_err"] = "prijmeni_pismena";
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/objednavka.php");
	die();
}

if (!preg_match('/^[0-9]{9}$/', $telefon_order)) {
	$_SESSION["objednavka_err"] = "nespravny_telefon";
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/objednavka.php");
	die();
}

$e_mail_order = filter_var($_POST["e_mail_order"], FILTER_SANITIZE_EMAIL);
if (!filter_var($e_mail_order, FILTER_VALIDATE_EMAIL)) {
	$_SESSION["objednavka_err"] = "email_validace";
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/objednavka.php");
	die();
}

if (!is_numeric($psc_order)) {
	$_SESSION["objednavka_err"] = "psc_neni_cislo";
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/objednavka.php");
	die();
}

if ($_POST["overit_adresu"]) {
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/dodaci_udaje_mapa.php");
	die();
}

if ($_POST["zpracovat"])
	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/objednavka_shrnuti.php");
