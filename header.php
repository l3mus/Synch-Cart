<?php
$servername = "wadestuff.net:3306";
$username = "wadestuf_brandon";
$password = "aaronsux";
$dbname = "wadestuf_testdb";


//$ID = explode(",", $_POST["qrcode"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users WHERE username = 'synchrony1'"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	//	echo "Name: " . $row["Name"] . "<br>";
		//$arr = array('ID0' => $ID[0], 'ID1' => $ID[1]);
		$arr = array('username' => $row["username"], 'accountNum' => $row["accountNum"]);
		//echo json_encode($arr);
    }
	
} else {
    echo "Error with database";
}

$conn->close();
?>