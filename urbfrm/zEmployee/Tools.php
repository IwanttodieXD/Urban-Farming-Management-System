<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools Inventory</title>
    <script src="../javascript/showforms.js"></script>
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/eventss.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
    <script src="../javascript/dropdownemployees.js"></script>
    <script src="../javascript/otherPlants.js"></script>
    <script src="../javascript/showforms.js"></script>
    <script src="../javascript/attendannce.js"></script>
    <script src="..//javascript/showinputfields.js"></script>
</head>
<body>
<div class="sidebar">
        <div class="sidebar-content">
            <ul class="nav-items"> 
                <li class="logo-item">
                    <img class="logo" src="../img/urban farming logo 3.png" alt="logo">
                </li>
                <li>
                    <i class="fas fa-calendar"></i><a href="Landing_Employee.html" class="item-text">Attendance</a>
                </li>
                <li>
                    <i class="fas fa-people-group"></i><a href="Leave_Application.php" class="item-text">Apply For Leave</a>
                </li>         
                <li>
                    <i class="fas fa-warehouse"></i><span class="item-text">Inventory</span>
                </li>
                <ul class="sub-inv" style="display: none;"> 
                    <li><i class="fas fa-trowel"></i><a href="Tools.php" class="item-text">Tools</a></li>
                    <li><i class="fas fa-trowel-bricks"></i><a href="Tools_Borrowed.php" class="item-text">Borrowed Tools</a></li>
                    <li><i class="fas fa-sack-xmark"></i><a href="PotMix.php" class="item-text">Pot Mix</a></li>
                </ul>
                <li>
                    <i class="fas fa-seedling"></i><span class="item-text">Plants</span>
                </li>
                <ul class="sub-plants" style="display: none;"> 
                    <li id="loadFruit"><i class="fas fa-apple-whole"></i><a a href="Plants_Fruit.php" class="item-text">Fruit Bearing</a></li>
                    <li><i class="fas fa-carrot"></i><a href="Plants_Root.php" class="item-text">Root Crops</a></li>
                    <li><i class="fas fa-leaf"></i><a href="Plants_Herbs.php" class="item-text">Herbs</a></li>
                </ul>
            </ul>
            <li class="last"><i class="fas fa-right-from-bracket"></i><a href="/urbfrm/landing_main.php" action="/urbfrm/php/sessionend.php" class="item-text">Log Out</a></li> <!-- Last item outside the wrapper -->
        </div>
    </div>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<div id="content">
<body>    <header>
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
    <table>
        <tr>
            <th>Item</th>
            <th>Stock</th>
            <th>Purchase Amount</th>
            <th>Remarks</th>
            <th></th>
        </tr>
        <tbody id="toolTableBody">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT ItemName, Count, PurchaseAmount, Remarks FROM tools";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ItemName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Count']) . "</td>";
                    echo "<td>" . "₱" . htmlspecialchars($row['PurchaseAmount']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Remarks']) . "</td>";
                    echo "<td><a href='#' class='button button-edit' onclick='showEditForm(\"{$row['ItemName']}\")'>Lend</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>
        <script>
            function showEditForm(itemName) {
            document.getElementById('item').value = itemName;
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('editForm').style.display = 'block';
        }
        </script>

    <div class="overlay" id="overlay"></div>
    
    <div class="container" id="editForm">
        <h2>Lend Tools</h2>
        <form class ="form1" action="/urbfrm/php/lendtool.php" method="POST">
            <div class="form-group">
                <label for="item">Item</label>
                <input type="text" id="item" name="item" required readonly>
            </div>
            <div class="form-group">
                <label for="stock">No. of items to Borrow</label>
                <input type="number" id="stock" name="stock" min="0" max="10" required>
            </div>
            <div class="flex">
                <label for="borrower">Borrower's Name</label>
                <input type="text" name="borrower" id="borrower" required>
            </div>
            <div class="form-group">
                <label for="affiliation">Affiliation</label>
                <select id="affiliation" name="affiliation" required onchange="showInputField()">
                    <option value="" disabled selected>Affiliation</option>
                    <option value="staff">Staff</option>
                    <option value="student">Student</option>
                </select><br>
            </div>
            
            <div id="studentIdContainer" class="hidden">
                <label for="studentId">Student ID</label>
                <input type="text" id="studentId" name="studentId" placeholder="Enter your Student ID">
            </div>
            
            <div id="facultyContainer" class="hidden">
                <label for="faculty">Employee ID</label>
                <input type="text" id="faculty" name="faculty" placeholder="Enter your Employee ID">
            </div>

            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="tel" id="contact" name="contact" required maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            </div><br><br>
            <div class="form-group">
                <button type="submit" name="button-done" class="button" id="button-done">Done</button>
                <a href="#" class="button button-cancel" onclick="hideEditForm()">Cancel</a>
            </div>
        </form>
    </div>
    <div class="container" id="insertForm">
        <h2>Insert Item</h2>
        <form>
            <div class="form-group">
                <label for="new-item">Item</label>
                <input type="text" id="new-item" name="new-item" required value="">
            </div>
            <div class="form-group">
                <label for="new-stock">Stock</label>
                <input type="number" id="new-stock" name="new-stock" min="0" required value="">
            </div>
            <div class="flex">
                <label for="new-purchase-amount">Purchase Amount</label>
                <input type="number" name="new-purchase-amount" id="new-purchase-amount" min="0" placeholder="₱0.00">
            </div>
            <div class="form-group">
                <label for="new-remarks">Remarks</label>
                <input type="text" id="new-remarks" name="new-remarks" required value="">
            </div><br><br>
            <div class="form-group">
                <button type="button" class="button button-done">Done</button>
                <a href="#" class="button button-cancel" onclick="hideInsertForm()">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        function formatAmount() {
            const input = document.getElementById('purchase-amount');
            let value = input.value.replace(/[^0-9.]/g, ''); 

            if (value) {
                value = parseFloat(value).toFixed(2);
                input.value = '₱' + value;
            } else {
                input.value = '';
            }
        }
    </script>
    <script src="../javascript/showinputfields.js"></script>
</div>
</body>
</html>