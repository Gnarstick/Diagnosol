<?php
//recupération des informations de connexion rentré sur la page précédente./ Get the loggin informations from the previous page.
$usernameinput = $_POST['place_name'];
$mdpinput = $_POST['place_mdp'];

//Salt utilisé pour le hashage du mdp stocké dans la db. / Salt use by the hash fonction on the password in the database.
$salt = "put_your_salt_here";

//hashage du mdp. / hashing of the mdp.
$mdphash = base64_encode(hash_pbkdf2("sha256", $mdpinput, $salt, 10000, 32, true));

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

session_start();

if (($_SESSION['login'] == "")&&!($usernameinput == ""))
{
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM users WHERE username = '$usernameinput'";

	$reponse = mysqli_query($conn, $sql);
	
	while($donnees = mysqli_fetch_array($reponse))
	{
		if ($donnees['password'] == $mdphash)
		{
			$_SESSION['login'] = $usernameinput;
			session_write_close();
			header('Location: /');
		}
		else
		{
			header('Location: ./connexionhtml.php');
		}
	}
}
else
{
	$_SESSION['login'] = "";
	header('Location: ./connexionhtml.php');
}

?>