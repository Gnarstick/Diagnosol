<?php

session_start();

$user = $_POST['place_name'];
$mdpinput = $_POST['place_mdp'];
$email = $_POST['place_mail'];

$salt = "put_your_salt_here";
echo $email;

//hashage du mdp. / hashing of the mdp.
$mdphash = base64_encode(hash_pbkdf2("sha256", $mdpinput, $salt, 10000, 32, true));

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM users WHERE username = '$user'";

	$reponse = mysqli_query($conn, $sql);
	while($donnees = mysqli_fetch_array($reponse))
	{
		$deja = true;
		$_SESSION['Last'] = "inscri";
		header('Location: ./inscriptionhtml.php');
	}

if (!$deja)
{	
	$sql2 = "INSERT INTO users (`username`, `password`, `email`, `profile_fields`, `group`, `last_login`, `login_hash`, `created_at`, `updated_at` ) VALUES ('$user', '$mdphash', '$email', 'a:0:{}', '1', '0', '', '0', '0')";
	//test pour voir si les data sont add comme il faut
	if (mysqli_query($conn, $sql2)) 
	{
	 //   echo "New record created successfully";
	} 
	else 
	{
	 // echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
	header('Location: ./connexionhtml.php');
}
?>