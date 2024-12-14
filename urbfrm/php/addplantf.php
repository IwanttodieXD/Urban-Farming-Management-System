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

//addbatch
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnAddplant'])) {

    $plant_name = $_POST['plant_name'];
    $other_plant = isset($_POST['other_plant']) ? $_POST['other_plant'] : null;
    $seeds_planted = $_POST['seeds_planted'];
    $planting_date = $_POST['planting_date'];
    $planting_note = isset($_POST['planting_note']) ? $_POST['planting_note'] : '';
    $employee_id = $_SESSION['employee_id'];
    $plant_type = 'Fruit';
    if ($plant_name == 'other') {
        $plant_name = $other_plant;
    }

    $stmt = $conn->prepare("INSERT INTO plantingrecords (PlantName, NoSeedsPlanted, PlantingDate, PlantingNote, EmployeeID, PlantType) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $plant_name, $seeds_planted, $planting_date, $planting_note, $employee_id, $plant_type);

    if ($stmt->execute()) {
        echo ("<script>alert('Success :D')</script>");
        header('Location: /urbfrm/zEmployee/Plants_Fruit.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

//transplant
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btntransave'])) {

    $numtrans = isset($_POST['numtrans']) ? $_POST['numtrans'] : null;
    $transdate = isset($_POST['transdate']) ? $_POST['transdate'] : null;
    $tremark = isset($_POST['tremark']) ? $_POST['tremark'] : '';
    $potting_mix = isset($_POST['potting_mix']) && is_array($_POST['potting_mix']) ? implode(', ', $_POST['potting_mix']) : '';
    $batchnum = isset($_POST['lblbatchnum']) ? $_POST['lblbatchnum'] : null;

    if (empty($numtrans) || empty($transdate)) {
        echo "Please fill in all required fields.";
    } else {

        $stmt = $conn->prepare("UPDATE plantingrecords SET NoSeedsTransplanted = ?, DateTransplanted = ?, TransplantingNote = ?, PotMixUsed = ? WHERE BatchNum = ?");
        $stmt->bind_param("isssi", $numtrans, $transdate, $tremark, $potting_mix, $batchnum);

    
        if ($stmt->execute()) {
            echo ("<script>alert('Success :D')</script>");
            header('Location: /urbfrm/zEmployee/Plants_Fruit.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

//addharvest
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnHarvest'])) {

    $plant_name = isset($_POST['lblPlantName']) ? $_POST['lblPlantName'] : null;
    $batchnum = isset($_POST['lblbatchnum']) ? $_POST['lblbatchnum'] : null;
    $harvest_date = $_POST['harvestdate'];
    $plants_harvested = $_POST['numharvested'];
    $harvested_quantity = $_POST['quantharvest'];
    $harvesting_note = isset($_POST['harvremark']) ? $_POST['harvremark'] : '';
    $employee_id = $_SESSION['employee_id'];
    $plant_type = 'Fruit';


    $stmt = $conn->prepare("INSERT INTO harvestingrecords (PlantName, PBatchNum, DateOfHarvest, NoPlantsHarvested, Quantity, Remarks, EmployeeID, PlantType) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisiisis", $plant_name, $batchnum, $harvest_date, $plants_harvested, $harvested_quantity, $harvesting_note, $employee_id, $plant_type);

    if ($stmt->execute()) {
        echo ("<script>alert('Success :D')</script>");
        header('Location: /urbfrm/zEmployee/Plants_Fruit.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();

?>
