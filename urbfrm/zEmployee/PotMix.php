<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potting Mix Inventory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<div id="content">
<body>
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
        <table>
            <tr>
                <th>Pot Mix</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
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
            $sql = "SELECT * FROM potmix";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['Stock'] > 5) {
                        $status = "In Stock";
                    } elseif ($row['Stock'] > 0) {
                        $status = "Low Stock";
                    } else {
                        $status = "Out of Stock";
                    }
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ItemName']) . "</td>";
        	        echo "<td>" . htmlspecialchars($row['Stock']) . "</td>";
                    echo "<td>" . htmlspecialchars($status) . "</td>";
                    echo "<td><a href='#' class='button button-edit' onclick=\"showEditForm('{$row['ItemName']}')\">Take</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }

            $conn->close();
            ?>
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

        <div class = "container" id="editForm">
            <h2>Edit Pot Mix</h2>
            <form action="/urbfrm/php/takepotmix.php" method="POST">
        <div class="form-group">
            <label for="item">Item</label>
            <input type="text" id = "item" name = "item" required readonly>
        </div>
        <div class="form-group">
            <label for="stock">Quantity to Take</label>
            <input type="number" id = "stock" name = "stock" min="0" max="100" required>
        </div>

        <div class="form-group">
        <button class = "button button-done" name="edtbtn" id="edtbtn" type="submit">Done</button>
        <a href="#" class = "button button-cancel" onclick="hideEditForm()">Cancel</a>
        </div>
        </form>
    </div>
</div>
</body>
</div>
</html>

