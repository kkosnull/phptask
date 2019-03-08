<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else
{

$email = isset($_POST['email']) ? $_POST['email'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$subject = isset($_POST['subject']) ? $_POST['subject'] : null;
$body = isset($_POST['body']) ? $_POST['body'] : null;

if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$sql = "INSERT INTO info (email, name, subject, body)VALUES ('".$email."', '".$name."', '".$subject."', '".$body."')";

	if ($conn->query($sql) === TRUE) 
		{
		   echo "Connected successfully and sent data :".$email. ", ".$name. ", ".$body.", ".$body."<br> ";
		} 
		else 
		{
		    echo "SQL error " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

		}
		else
		{
			echo "email error : email not valid";
		}
}


?>