<?php

session_start();
$userlog = $_SESSION['login'];

if ($userlog == "")
{
	header('Location: ./connexionhtml.php');
}
else
{

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";


$nom = $_GET['Nom'];
$owner = $_GET['Owner'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM onduleurs WHERE Nom = '$nom'AND owner= '$owner'";

mysqli_query($conn, $sql);
mysqli_close($conn);


header('Location: onduleur.php');
}
?> 