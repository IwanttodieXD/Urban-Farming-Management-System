<?php
session_start(); // Start the session at the beginning of the file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potting Mix Inventory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../javascript/showforms.js"></script>
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
    <script src="../javascript/dropdown.js"></script>
    <script src="../javascript/otherPlants.js"></script>
    <script src="../javascript/showforms.js"></script>
    <script src="../javascript/attendannce.js"></script>
</head>
<body>
<div class="sidebar">
        <div class="sidebar-content">
            <ul class="nav-items"> 
                <li class="logo-item">
                    <img class="logo" src="../img/urban farming logo 3.png" alt="logo">
                </li>
                <li>
                    <i class="fa-regular fa-calendar-check"></i><a href="Landing_Admin.html" class="item-text">Attendance</a>
                </li>
                <li>
                    <i class="fas fa-people-group"></i><span class="item-text">Human Resources</span>
                </li>
                <ul class="sub-hr" style="display: none;">
                    <li><i class="fa-regular fa-address-book"></i><a href="PersonnelList.php" class="item-text">Employee List</a><i></i></li>
                    <li><i class="fas fa-user-plus"></i><a href="Personnel_Add.html" class="item-text">Add Personnel</a></li>
                    <li><i class="fas fa-file-pen"></i><a href="Leave_Approval.php" class="item-text">Leave Application</a></li>
                    <li><i class="fa-regular fa-calendar-check"></i><a href="AttendanceSummary.php" class="item-text">Attendance Summary</a></li>
                    
                </ul>
                <li>
                    <i class="fas fa-warehouse"></i><span class="item-text">Inventory</span>
                </li>
                <ul class="sub-inv" style="display: none;"> 
                    <li><i class="fas fa-trowel"></i><a href="Admin_InvTools.php" class="item-text" >Tools</a></li>
                    <li><i class="fas fa-sack-xmark"></i><a href="Admin_InvPotMix.php" class="item-text">Pot Mix</a></li>
                    <li><i class="fa-regular fa-clipboard"></i><a href="Records_Tool.php" class="item-text">Tools Records</a></li>
                    <li><i class="fa-regular fa-clipboard"></i><a href="Records_PotMix.php" class="item-text" >Inventory Records</a></li>
                </ul>
                <li>
                    <i class="fas fa-seedling"></i><span class="item-text">Plants</span>
                </li>
                <ul class="sub-plants" style="display: none;"> 
                    <li><i class="fas fa-apple-whole"></i><a href="Plants_Records.php" class="item-text" >Plant Records</a></li>
                </ul>
                <li><i class="fa-regular fa-calendar"></i><a href="Events_Manage.php" class="item-text" >Events</a></li>
            </ul>
            <li class="last"><i class="fas fa-right-from-bracket"></i><a href="/urbfrm/landing_main.php" action="/urbfrm/php/sessionend.php" class="item-text">Log Out</a></li>
        </div>
    </div>
    <div id="content">
    <header>
        <div class="info-container">
            <div class="text">Quezon City University - Center for Urban and Agriculture Innovation</div>
            <img src="../img/urban farming logo 3.png" alt="Logo" class="info-image">
        </div>
        
        <div class="content">
            <div class="location">
                Potting Mix / <span class="currentlocation">Inventory</span>
            </div>
        </div>
    </header>
    
    <div class="table-container">
        <a href="#" class="button button-add" onclick="showInsertForm(event)">Insert</a>
        <br><br>
    
        <table>
            <tr>
                <th>Pot Mix</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM potmix";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }
            while($row = $result->fetch_assoc()){
                // Determine the status based on the stock level
                if ($row['Stock'] > 5) {
                    $status = "In Stock";
                } elseif ($row['Stock'] > 0) {
                    $status = "Low Stock";
                } else {
                    $status = "Out of Stock";
                }

                echo "
                    <tr>
                        <td>{$row['ItemName']}</td>
                        <td>{$row['Stock']}</td>
                        <td>{$status}</td>
                        <td>
                            <a href='#' class='button button-edit' onclick=\"showEditForm({$row['MixID']}, '{$row['ItemName']}', {$row['Stock']})\">Edit</a>
                            <a href='/urbfrm/php/deletepotmix.php?MixID={$row['MixID']}' class='button button-delete' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                        </td>
                    </tr>
                ";
            }
            ?>
        </table>
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="container" id="insertForm">
        <h2>Insert Pot Mix</h2>
        <div class="message">
            <?php
            if (isset($_SESSION[' message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
        </div>
        <form method="post" action="\urbfrm\php\insertpotmix.php">
            <div class="form-group">
                <label for="item">Item</label>
                <input type="text" id="item" name="item" required value="">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" min="0" max="100" required value="">
            </div>
            <div class="form-group">
                <button class="button button-done" type="submit">Done</button>
                <button class="button button-cancel" type="button" onclick="hideInsertForm()">Cancel</button>
            </div>
        </form>
    </div>

    <div class="container" id="editForm" style="display:none;">
        <h2>Edit Pot Mix</h2>
        <div class="message" id="editMessage"></div>
        <form method="post" action="\urbfrm\php\updatepotmix.php" id="updateForm">
            <input type="hidden" id="editMixID" name="MixID" value="">
            <div class="form-group">
                <label for="editItem">Item</label>
                <input type="text" id="editItem" name="item" required value="">
            </div>
            <div class="form-group">
                <label for="editStock">Stock</label>
                <input type="number" id="editStock" name="stock" min="0" max="100" required value="">
            </div>
            <div class="form-group">
                <button class="button button-done" type="submit">Update</button>
                <button class="button button-cancel" type="button" onclick="hideEditForm()">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        function showInsertForm(event) {
            event.preventDefault();
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('insertForm').style.display = 'block';
        }

        function hideInsertForm() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('insertForm').style.display = 'none';
        }

        function showEditForm(mixID, itemName, stock) {
            document.getElementById('editMixID').value = mixID;
            document.getElementById('editItem').value = itemName;
            document.getElementById('editStock').value = stock;
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('editForm').style.display = 'block';
        }

        function hideEditForm() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('editForm').style.display = 'none';
        }
    </script>
    </div>
</body>
</html>