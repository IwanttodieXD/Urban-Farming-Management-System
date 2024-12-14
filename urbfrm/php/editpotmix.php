<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qcu-cuai";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mixID = $_POST['MixID'];
    $item = $_POST['item'];
    $stock = $_POST['stock'];

    $sql = "UPDATE potmix SET ItemName=?, Stock=? WHERE MixID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $item, $stock, $mixID);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Pot mix updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating pot mix: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: Admin_InvPotMix.php");
    exit();
} else {
    $mixID = $_GET['MixID'];
    $sql = "SELECT * FROM potmix WHERE MixID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mixID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pot Mix</title>
</head>
<body>
    <h2>Edit Pot Mix</h2>
    <form method="post" action="editpotmix.php">
        <input type="hidden" name="MixID" value="<?php echo $row['MixID']; ?>">
        <div>
            <label for="item">Item</label>
            <input type="text" id="item" name="item" required value="<?php echo $row['ItemName']; ?>">
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" min="0" max="100" required value="<?php echo $row['Stock']; ?>">
        </div>
        <div>
            <button type="submit">Update</button>
            <a href="Admin_InvPotMix.php">Cancel</a>
        </div>
    </form>
</body>
</html>