<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Root Crops</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/plant.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/eventss.css">
    <script src="https://kit.fontawesome.com/932507f259.js" crossorigin="anonymous"></script>
    <script src="../javascript/dropdownemployees.js"></script>
    <script src="../javascript/otherPlants.js"></script>
    <link rel="stylesheet" href="../css/header.css">
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
                Root Crops / <span class="currentlocation">Plants</span>
            </div>
        </div>
    </header>

    <div class="panel1">
    <form class="form1" action="/urbfrm/php/addplantr.php" method="POST">
            <div class="panel-header">Add Batch</div>
    
            <label for="plantname">Root Crops</label>
            <select id="plantname" name="plant_name" required onchange="handlePlantSelection()">
                <option value="" disabled selected>Please Choose a Root Crop to Add</option>
                <option value="cassava">Cassava</option>
                <option value="kamote">Kamote</option>
                <option value="uraro">Uraro</option>
                <option value="other">Others</option>
            </select><br>

            <div id="otherPlantContainer" style="display: none;">
                <label for="other_plant">Please specify:</label>
                <input type="text" id="other_plant" name="other_plant">
            </div>
    
            <label for="seeds_planted">Seeds Planted</label>
            <input type="number" id="seeds_planted" name="seeds_planted" required>

            <label for="planting_date">Planting Date</label>
            <input type="date" id="planting_date" name="planting_date" required>
    
            <label for="planting_note">Planting Note</label>
            <textarea id="planting_note" name="planting_note"></textarea><br><br>
    
            <button id="btnAddplant" name="btnAddplant" type="submit">ADD BATCH</button>
            <script> 
            document.getElementById('btnAddplant').addEventListener('click', function() {
                alert('Success! :D');
            });
            </script>
        </form>

        <form class="form1" id="searchForm">
            <div class="panel-header">Search Batch</div>
            
            <label for="batchnum">Batch</label>
            <input class="inputa" type="number" name="batchnum" id="batchnum" placeholder="Batch Number of Plant to Search and Update">
            
            <label for="SearchPlant">Plant</label>
            <select id="searchplantname" name="plant_name" required onchange="handlePlantUpdate()">
                <option value="" disabled selected>Please Choose a Root Crop to Search</option>
                <option value="cassava">Cassava</option>
                <option value="kamote">Kamote</option>
                <option value="uraro">Uraro</option>
                <option value="other">Others</option>
            </select><br><br>

            <div id="otherPlantSearch" style="display: none;">
                <label for="other_plant">Please specify:</label>
                <input type="text" id="other_plantsearch" name="other_plant">
            </div>
            
            <button id="btSearch" type="submit">SEARCH</button>
        </form>
        <script src="/search.js"></script>
    </div>  
    
    <div class="panelinfos">
        <h2>BATCH NUMBER:</h2>
        <h2 id="lblbatch">(BATCH NO)</h2>
        <h2>OF:</h2>
        <h2 id="lblplant">(PLANT NAME)</h2>
    </div>
    
    <div class="panel1">
        <form class="form2" id="form2" action="/urbfrm/php/addplantr.php" method="POST">
            <div class="panel-header">Transplanting</div>
            
            <label for="lblbatchnum" style="display: none;"></label>
            <input type="number" id="lblbatchnum" name="lblbatchnum" style="display: none;">

            <label for="numtrans">No. of Seedlings Transplanted:</label>
            <input type="number" id="numtrans" name="numtrans" placeholder="Number of seedlings transplanted"> 
    
            <label for="transdate">Date Transplanted:</label>
            <input type="date" id="transdate" name="transdate" placeholder="Date transplanted">  
    
            <label class="label" for="tremark">Notes:</label>
            <input class="input" type="text" id="tremark" name="tremark" placeholder="Notes"> 
    
            <div class="panel-header">Potting Mix and Fertilizers Used</div>
            
            <fieldset id="fldpotmix" class="fieldset1">
                <legend>Select Potting Mix Used:</legend>
                <div class="checkbox-container">
                    <label>
                    <input type="checkbox" name="potting_mix[]" value="Top Soil">
                        Top Soil
                    </label>
                    <label>
                        <input type="checkbox" name="potting_mix[]" value="Rice Hull">
                        Rice Hull
                    </label>
                    <label>
                        <input type="checkbox" name="potting_mix[]" value="Carbonized Rice Hull">
                        Carbonized Rice Hull
                    </label>
                    <label>
                        <input type="checkbox" name="potting_mix[]" value="Coco Peat">
                        Coco Peat
                    </label>
                    <label>
                        <input type="checkbox" name="potting_mix[]" value="Coco Coir">
                        Coco Coir
                    </label>
                    <label>
                        <input type="checkbox" name="potting_mix[]" value="Compost">
                        Compost
                    </label>
                    <label>
                        <input type="checkbox" name="potting_mix[]" value="Vermicast">
                        Vermicast
                    </label>
                    <label>
                        <input type="checkbox" name="potting_mix[]" value="Manure">
                        Manure
                    </label>
                </div>
            </fieldset><br><br>
            <button id="btntransave" name="btntransave" type="submit">SAVE</button>
        </form>
    
        <form class="form2" action="/urbfrm/php/addplantr.php" method="POST">
            <div class="panel-header">Harvesting</div>
            
            <label for="lblPlantName" style="display: none;"></label>
            <input type="text" id="lblPlantName" name="lblPlantName" style="display: none;"> 

            <label for="lblbatchnum1" style="display: none;"></label>
            <input type="number" id="lblbatchnum1" name="lblbatchnum" style="display: none;">

            <label for="harvestdate">Date Harvested:</label>
            <input type="date" name="harvestdate" id="harvestdate">
        
            <label for="numharvested">Number of Plants Harvested:</label>
            <input type="number" name="numharvested" id="numharvested" placeholder="Number of plants ready for Harvesting">
        
            <label for="quantharvest">Quantity of Fruits Harvested (kilogram):</label>
            <input type="number" name="quantharvest" id="quantharvest" placeholder="Quantity of Fruits Harvested (kilogram)">
        
            <label for="harvremark">Remarks:</label>
            <textarea class="inputrem" name="harvremark" id="harvremark" placeholder="Notes"></textarea>
            <br><br>
            <button id="btnHarvest" name="btnHarvest" type="submit">HARVEST</button>
        </form>
    </div>
<script>
  document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const batchNumber = document.getElementById('batchnum').value.trim(); 
    const plantName = document.getElementById('searchplantname').value.trim();

    if (plantName === 'other') {
        const otherPlantName = document.getElementById('other_plantsearch').value.trim();
        document.getElementById('lblbatch').textContent = batchNumber;
        document.getElementById('lblPlantName').value = otherPlantName.charAt(0).toUpperCase() + otherPlantName.slice(1);
        document.getElementById('lblbatchnum').value = batchNumber;
        document.getElementById('lblbatchnum1').value = batchNumber;
        document.getElementById('lblplant').textContent = otherPlantName.charAt(0).toUpperCase() + otherPlantName.slice(1);
    } else {
        document.getElementById('lblbatch').textContent = batchNumber;
        document.getElementById('lblplant').textContent = plantName.charAt(0).toUpperCase() + plantName.slice(1);
        document.getElementById('lblbatchnum').value = batchNumber;
        document.getElementById('lblbatchnum1').value = batchNumber;
        document.getElementById('lblPlantName').value = plantName.charAt(0).toUpperCase() + plantName.slice(1);
    }

    if (!batchNumber || !plantName) {
        alert('Please fill out both fields.'); 
        return;
    }
    
    });
</script>

    <div class="tablediv">
    <h1>Planting Data</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Plant Name</th>
                <th>Batch</th>
                <th>No. Seeds Planted</th>
                <th>Planting Note</th>
                <th>Date Planted</th>
                <th>No. Seeds Transplanted</th>
                <th>Date Transplanted</th>
                <th>Transplanting Notes</th>
                <th>Potting Mix Used</th>
            </tr>
        </thead>
        <tbody id="plantTableBody">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT PlantName, BatchNum, NoSeedsPlanted, PlantingNote, PlantingDate, NoSeedsTransplanted, DateTransplanted, TransplantingNote, PotMixUsed FROM plantingrecords WHERE PlantType = 'Root Crops' ORDER By BatchNum DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['PlantName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['BatchNum']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NoSeedsPlanted']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PlantingNote']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PlantingDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NoSeedsTransplanted']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DateTransplanted']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['TransplantingNote']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PotMixUsed']) . "</td>";
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

    <div class="tablediv">
        <h1>Harvesting Data</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Plant Name</th>
                    <th>Batch</th>
                    <th>Harvest Batch</th>
                    <th>Date Harvested</th>
                    <th>Plants Ready to Harvest</th>
                    <th>Quantity of Harvest (kg)</th>
                    <th>Harvesting Notes</th>
                </tr>
            </thead>
            <tbody id="plantTableBody">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "qcu-cuai";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT PlantName, PBatchNum, HBatchNum, DateOfHarvest, NoPlantsHarvested, Quantity, Remarks FROM harvestingrecords WHERE PlantType = 'Root Crops' ORDER By HBatchNum DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['PlantName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PBatchNum']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['HBatchNum']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DateOfHarvest']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NoPlantsHarvested']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Quantity']) . " kg </td>";
                    echo "<td>" . htmlspecialchars($row['Remarks']) . "</td>";
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
</body>
</div>
</html>