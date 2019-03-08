<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
else
{

$email = isset($_POST['email']) ? $_POST['email'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$subject = isset($_POST['subject']) ? $_POST['subject'] : null;
$body = isset($_POST['body']) ? $_POST['body'] : null;

$sql = "SELECT  * FROM info WHERE ( email='".$email."') OR (name ='".$name."') OR (subject ='".$subject."') OR (body= '".$body."')";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Email found :" . $row["email"];
    }
} else {
    echo "0 results";
}
$conn->close();

	

}
	



?>