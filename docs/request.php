<?php
header('Content-Type: application/json');
$servername = "wadestuff.net:3306";
$username = "wadestuf_brandon";
$password = "aaronsux";
$dbname = "wadestuf_testdb";


$ID = explode(",", $_POST["qrcode"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM Items WHERE ID=".$ID[1]." AND Merchant_ID=".$ID[0];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	//	echo "Name: " . $row["Name"] . "<br>";
		//$arr = array('ID0' => $ID[0], 'ID1' => $ID[1]);
		$arr = array('ID' => $row["ID"], 'Name' => $row["Name"], 'Merchant' => $row["Merchant_ID"],
		'SKU' => $row["SKU"], 'Price' => $row["Price"], 'Category' => $row["Category"], 'Image' => base64_encode( $row["Image"]));
		//print_r( $arr);
		echo json_encode($arr);
    }
	
} else {
    echo $ID[1];//"0 results";
}

$conn->close();
?>