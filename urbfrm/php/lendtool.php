<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "qcu-cuai";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//lend update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button-done'])) {

    $item = isset($_POST['item']) ? $_POST['item'] : null;
    $stock = isset($_POST['stock']) ? $_POST['stock'] : null;

        $stmt = $conn->prepare("UPDATE tools SET Count = Count - ? WHERE ItemName = ?");
        $stmt->bind_param("is", $stock, $item);

    
        if ($stmt->execute()) {
            echo ("<script>alert('Success :D')</script>");
            header('Location: /urbfrm/zEmployee/Tools.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

//addbororweer
if (isset($_POST['faculty'], $_POST['studentId'], $_POST['affiliation'], $_POST['item'], $_POST['stock'], $_POST['borrower'], $_POST['contact'])) {
    $employee_id = $_POST['faculty'];
    $student_id = $_POST['studentId'];
    $baffil = $_POST['affiliation'];
    $itemname = $_POST['item'];
    $quantity = $_POST['stock'];
    $bname = $_POST['borrower'];
    $bcontact = $_POST['contact'];
    $bdate = date("Y-m-d"); 
    $bstatus = 'Borrowed';

    $stmt = $conn->prepare("INSERT INTO toolsusage (Student_Id, Baffil, ToolName, Quantity, Bname, Bcontact, UsageDate, Bstatus, EmployeeID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisisss", $student_id,  $baffil, $itemname, $quantity, $bname, $bcontact, $bdate, $bstatus, $employee_id);

    if ($stmt->execute()) {
        echo ("<script>alert('Success :D')</script>");
        header('Location: /urbfrm/zEmployee/Tools.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();

?>
