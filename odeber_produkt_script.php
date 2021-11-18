<?php
if (!stristr($_SERVER["HTTP_REFERER"], "kosik.php"))
	die("Script nelze volat z jiné stránky, něž z košíku.");

$servername = "dbs.spskladno.cz";
$username = "student14";
$password = "spsnet";
$dbname = "vyuka14";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn)
	die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

$sql_kolik_produktu = "SELECT COUNT(id_pordukt_kosik) AS kolik_produktu FROM Kosik";
$result_kolik_produktu = mysqli_query($conn, $sql_kolik_produktu);

if (mysqli_num_rows($result_kolik_produktu) > 0) {
	while ($row = mysqli_fetch_assoc($result_kolik_produktu)) {
		$kolik_produktu = $row["kolik_produktu"];
	}
}

$id_produktu = array(0);

$sql_id_produktu = "SELECT id_pordukt_kosik FROM Kosik";
$result_id_produktu = mysqli_query($conn, $sql_id_produktu);

if (mysqli_num_rows($result_id_produktu) > 0) {
	while ($row = mysqli_fetch_assoc($result_id_produktu)) {
		array_push($id_produktu, (int)$row["id_pordukt_kosik"]);
	}
}


for ($id_produktu_update = 1; $id_produktu_update <= $kolik_produktu; $id_produktu_update++) {
	$sql_update_id = "UPDATE Kosik SET id_pordukt_kosik=$id_produktu_update WHERE id_pordukt_kosik=$id_produktu[$id_produktu_update]";
	mysqli_query($conn, $sql_update_id);
}

$post = implode("", $_POST);
$post = (int)$post;

$sql_delete = "DELETE FROM Kosik WHERE id_pordukt_kosik=$post";

if (!mysqli_query($conn, $sql_delete))
	die("Nepodařilo se záznam vymazat. Zkuse to pouději.");

$sql_kolik_produktu = "SELECT COUNT(id_pordukt_kosik) AS kolik_produktu FROM Kosik";
$result_kolik_produktu = mysqli_query($conn, $sql_kolik_produktu);

if (mysqli_num_rows($result_kolik_produktu) > 0) {
	while ($row = mysqli_fetch_assoc($result_kolik_produktu)) {
		$kolik_produktu = $row["kolik_produktu"];
	}
}

$id_produktu = array(0);

$sql_id_produktu = "SELECT id_pordukt_kosik FROM Kosik";
$result_id_produktu = mysqli_query($conn, $sql_id_produktu);

if (mysqli_num_rows($result_id_produktu) > 0) {
	while ($row = mysqli_fetch_assoc($result_id_produktu)) {
		array_push($id_produktu, (int)$row["id_pordukt_kosik"]);
	}
}


for ($id_produktu_update = 1; $id_produktu_update <= $kolik_produktu; $id_produktu_update++) {
	$sql_update_id = "UPDATE Kosik SET id_pordukt_kosik=$id_produktu_update WHERE id_pordukt_kosik=$id_produktu[$id_produktu_update]";
	mysqli_query($conn, $sql_update_id);
}

header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/kosik.php");
mysqli_close($conn);
