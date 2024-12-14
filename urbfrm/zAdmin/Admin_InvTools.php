<?php
session_start(); // Start the session at the beginning of the file

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qcu-cuai";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tools from the database
$sql = "SELECT * FROM tools";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Tools Inventory</title>
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
            <li class="last"><i class="fas fa-right-from-bracket"></i><a href="/urbfrm/landing_main.php" action="/urbfrm/php/sessionend.php" class="item-text">Log Out</a></li> <!-- Last item outside the wrapper -->
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
                Tools / <span class="currentlocation">Inventory</span>
            </div>
        </div>
    </header>

    <div class="table-container">
        <div><a href="#" class="button button-add" role="button" onclick="showInsertForm(event)">Insert</a></div>
        <br><br>
        <table>
            <tr>
                <th>Item</th>
                <th>Stock</th>
                <th>Purchase Amount</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$row['ItemName']}</td>
                            <td>{$row['Count']}</td>
                            <td>₱{$row['PurchaseAmount']}</td>
                            <td>{$row['Remarks']}</td>
                            <td>
                                <a href='#' class='button button-edit' onclick=\"showEditForm('{$row['ToolID']}', '{$row['ItemName']}', {$row['Count']}, {$row['PurchaseAmount']}, '{$row['Remarks']}')\">Edit</a>
                                <a href='\urbfrm\php\deletetool.php?ToolID={$row['ToolID']}' class='button button-delete' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                            </td>
                        </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='5'>No tools available</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="overlay" id="overlay"></div>

    <!-- Insert Form -->
    <div class="container" id="insertForm" style="display:none;">
        <h2>Insert Item</h2>
        <form method="post" action="\urbfrm\php\inserttool.php">
            <div class="form-group">
                <label for="new-item">Item</label>
                <input type="text" id="new-item" name="item" required value="">
            </div>
            <div class="form-group">
                <label for="new-stock">Stock</label>
                <input type="number" id="new-stock" name="stock" min="0" required value="">
            </div>
            <div class="form-group">
                <label for="new-purchase-amount">Purchase Amount</label>
                <input type="number" name="purchase_amount" id="new-purchase-amount" min="0" required value="">
            </div>
            <div class="form-group">
                <label for="new-remarks">Remarks</label>
                <input type="text" id="new-remarks" name="remarks" required value="">
            </div>
            <div class="form-group">
                <button type="submit" class="button button-done">Done</button>
                <button type="button " class="button button-cancel" onclick="hideInsertForm()">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Edit Form -->
    <div class="container" id="editForm" style="display:none;">
        <h2>Edit Item</h2>
        <form method="post" action="\urbfrm\php\updatetool.php">
            <input type="hidden" id="editToolID" name="ToolID" value="">
            <div class="form-group">
                <label for="edit-item">Item</label>
                <input type="text" id="edit-item" name="item" required value="">
            </div>
            <div class="form-group">
                <label for="edit-stock">Stock</label>
                <input type="number" id="edit-stock" name="stock" min="0" required value="">
            </div>
            <div class="form-group">
                <label for="edit-purchase-amount">Purchase Amount</label>
                <input type="number" name="purchase_amount" id="edit-purchase-amount" min="0" required value="">
            </div>
            <div class="form-group">
                <label for="edit-remarks">Remarks</label>
                <input type="text" id="edit-remarks" name="remarks" required value="">
            </div>
            <div class="form-group">
                <button type="submit" class="button button-done">Update</button>
                <button type="button" class="button button-cancel" onclick="hideEditForm()">Cancel</button>
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

        function showEditForm(toolID, itemName, stock, purchaseAmount, remarks) {
            document.getElementById('editToolID').value = toolID;
            document.getElementById('edit-item').value = itemName;
            document.getElementById('edit-stock').value = stock;
            document.getElementById('edit-purchase-amount').value = purchaseAmount;
            document.getElementById('edit-remarks').value = remarks;
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