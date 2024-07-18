<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "family_tree";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM nodes";
$result = $conn->query($sql);

$nodes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nodes[] = $row;
    }
}

$conn->close();

echo json_encode($nodes);
?>
