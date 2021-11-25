<!DOCTYPE html>
<html>

<head>
	<title>Přihášní - script</title>
</head>

<body>
	<?php
	session_start();
	if ($_POST == [])
		die("Script nelze volat přímo");

	$e_mail = "";
	$heslo = "";

	$_SESSION["e_mail"] = $_POST["e_mail"];
	$_SESSION["heslo"] = $_POST["heslo"];

	$e_mail = $_SESSION["e_mail"];
	$heslo = hash("sha256", $_SESSION["heslo"]);

	$_SESSION["login_err"] = "";

	if ($_POST["e_mail"] == "" || $_POST["heslo"] == "") {
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/e-shop_neuplne_udaje");
		die();
	}

	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn)
		die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

	$sql = "SELECT * FROM Zakaznik WHERE email_zakaznik = \"$e_mail\"";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row["email_zakaznik"] != $e_mail || $row["heslo_zakaznik"] != $heslo) {
				$_SESSION["login_err"] = "udaje_nespravne";
				header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login");
				die();
			} else {
				$_SESSION["jmeno"] = $row["jmeno_zakaznik"];
				$_SESSION["prijmeni"] = $row["prijmeni_zakaznik"];
				header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/e-shop_hlavni_strana");
				die();
			}
		}
	} else {
		$_SESSION["login_err"] = "e_mail_neexistuje";
		header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login");
		die();
	}
	mysqli_close($conn);
	?>
</body>

</html>