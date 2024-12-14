<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/headerlanding.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <title>Login</title>
</head>
<body>
    
    <header>
        <div class="info-container">
            <div class="text">Quezon City University - Center for Urban and Agriculture Innovation</div>
            <img src="img/urban farming logo 3.png" alt="Logo" class="info-image">
        </div>
    </header>
    <div class="bg">
        <div class="loginform">
            <form class="login" action="login.php" method="POST">
                <div>
                    <h2>Hello, Again</h2>
                    <small>We are happy to have you back.</small>
                </div>
                <br><br>
                <div class="input-field">
                    <label for="logEmail">Email address</label>
                    <input type="text" name="email" class="input-box" id="logEmail" placeholder="Enter Email Address" required>
                </div>
                <div class="input-field">
                    <label for="logPassword">Password</label>
                    <input type="password" name="password" class="input-box" id="logPassword" placeholder="Enter Password" required>
                </div>
                <div class="input-filed">
                    <button type="submit" class="submit">Sign In</button>
                </div>
            </form>
        </div>
    </div>
    <?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'qcu-cuai');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'] ?? ''; 
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM employee_tb WHERE `Email` = ? AND `Password` = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = $user['UserType'];
        $_SESSION['employee_id'] = $user['EmployeeID'];

        // Redirect based on user type
        if ($user['UserType'] === 'admin') {
            header("Location: /urbfrm/zAdmin/Landing_Admin.html");
        } else {
            header("Location: /urbfrm/zEmployee/Landing_Employee.html");
        }
        exit;
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
