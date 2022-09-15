<?php
    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    function sanitizeValue($value) {
        return htmlspecialchars( stripslashes( trim( $value ) ) );
    }

    if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
        $username = sanitizeValue($_POST['username']);
        $password = sanitizeValue($_POST['password']);
        $firstName = sanitizeValue($_POST['firstName']);
        $lastName = sanitizeValue($_POST['lastName']);

        
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        
         
        $conn = mysqli_connect("localhost", "root", "root", "project");
        
        $sql = "SELECT *
                FROM users 
                WHERE username = '$username'
        ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class = 'w3-red w3-panel'>Sorry, that username is taken</div>";
        }else{



        try {
            $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', 'root');
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $sql = 'INSERT INTO users ' .
            '  (username, password, firstName, lastName) ' .
            'VALUES ' .
            "  ('$username', '$passwordHash' , '$firstName', '$lastName')";
            
            if ( $pdo->exec($sql) ) {
                echo '
                <title>Account Confirmation</title>
                <h1 class = "w3-margin">Congratulations, your account has been created!</h1>',
                '<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">',
                '<p class = "w3-margin"><button id="login" class="w3-btn w3-blue w3-right-align " href = "Login.php">Return to login</button>
                    <script type="text/javascript">
                    document.getElementById("login").onclick = function () {
                    location.href = "Login.php";
                    };
                </script></p>';
                $pdo = null;
                die;
            } else {
                die("Sorry, could not create your account.");
            }
        } catch (PDOException $e) {
            die ( $e->getMessage() );
        }   
        
        }
        

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="w3-container w3-margin-left">
    <div class="w3-card w3-light-gray">
            <header class="w3-container w3-blue w3-margin-top">
                <h1>Create an Account</h1>
            </header>
    <form action="Register.php" method="POST" class = "w3-container" id="validationForm">
        <p>
            <label>Username<span class="w3-text-red">*</span>: [5-20 characters]
            <br>
            <input id = "usernameText" name="username" autofocus required></label>
            <i id="usernameIcon" class="w3-large"></i>
        </p>
        <p>
            <label>Password<span class="w3-text-red">*</span>: [5-30 characters]
            <br><input id = "passwordText" type="password" name="password" required></label>
            <i id="passwordIcon" class="w3-large"></i>
        </p>
        <p>
            <label>First Name<span class="w3-text-red">*</span>: 
            <br><input id = "firstNameText" name="firstName" required> </label>
            <i id="firstNameIcon" class="w3-large"></i>
        </p>
        <p>
            <label>Last Name<span class="w3-text-red">*</span>: 
            <br><input id = "lastNameText" name="lastName" required> </label>
            <i id="lastNameIcon" class="w3-large"></i>
        </p>
        <p>
        
            <input type="submit" class = "w3-btn w3-green w3-right-align" value="Create Account">
        </p>
    </form>
    </div>
    <br>
    <div class = "w3-margin">
    <button id="login" class="w3-btn w3-blue w3-right-align " href = "Login.php">
                        Cancel and return to login</button>
                    <script type="text/javascript">
                    document.getElementById("login").onclick = function () {
                    location.href = "logout.php";
                    };
                </script>
    </div>
    
    <script src="js/registrationChecker.js"></script>
</body>
</html>