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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rootName = $_POST['rootName'] ?? null;
    $parentName = $_POST['parentName'] ?? null;
    $childNames = $_POST['childNames'] ?? [];

    $stmt = $conn->prepare("INSERT INTO nodes (rootName, parentName, childName) VALUES (?, ?, ?)");

    if ($rootName) {
        $stmt->bind_param("sss", $rootName, $null, $null);
        $null = null;
        $stmt->execute();
    }

    if ($parentName && count($childNames) > 0) {
        foreach ($childNames as $childName) {
            $stmt->bind_param("sss", $null, $parentName, $childName);
            $stmt->execute();
        }
    }

    $stmt->close();
}

$conn->close();

// Redirect to index.html
echo "<script>window.location.href = 'index.html';</script>";
exit;
?>
