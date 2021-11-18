<!DOCTYPE html>
<html>

<head>
	<title>Ověření mailu - script</title>
</head>

<body>
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
		if ($_POST == [])
			die("Script nelze volat přímo");

		$email_kod = $_POST["verify"];
		$kod = $_SESSION["kod"];

		$jmeno = $_SESSION["jmeno"];
		$prijmeni = $_SESSION["prijmeni"];
		$e_mail = $_SESSION["e_mail"];
		$heslo = $_SESSION["heslo"];
		$heslo = hash("sha256", $heslo);

		if ($email_kod != $kod) {
			header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/e-shop_registrace_script_err.php");
			die();
		}


		if ($email_kod == $kod) {
			$servername = "dbs.spskladno.cz";
			$username = "student14";
			$password = "spsnet";
			$dbname = "vyuka14";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn)
				die("Nepodařilo se navázat spojení se serverem. Zkuste to později.");

			$sql = "INSERT INTO Zakaznik (jmeno_zakaznik, prijmeni_zakaznik, email_zakaznik, heslo_zakaznik) VALUES ('$jmeno', '$prijmeni', '$e_mail', '$heslo')";

			mysqli_query($conn, $sql);
			mysqli_close($conn);
			echo "Váš email byl ověřen.<br>";

			session_unset();
			session_destroy();
			header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/login.php");
		}
		?>