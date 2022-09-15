<?php 
    declare(strict_types = 1);

    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $curYear = date('Y');
    $username = $password = $errorMessage = "";
    $phpScript = sanitizeValue($_SERVER['PHP_SELF']);

    function sanitizeValue($value) {
        return htmlspecialchars( stripslashes( trim( $value ) ) );
    }

    if ( $_SERVER['REQUEST_METHOD'] == 'POST') {    
        require_once 'inc.db.php';


        $username = sanitizeValue($_POST['username']); 
        $password = sanitizeValue($_POST['password']); 


        $pdo = new PDO(CONNECT_MYSQL, USER, PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT password 
                FROM users
                WHERE username = '$username'
                ";       

        $pdoStatement = $pdo->query($sql);
        $valueFromTable = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        $passFromDB = $valueFromTable['password'];

        if($passFromDB == NULL){
            echo "<div class = 'w3-red w3-panel'>Incorrect username or password.</div>";
        }
        else if( password_verify($password, $passFromDB) )
        {    
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            header('Location: Home.php');
        } 
        else {
            echo "<div class = 'w3-red w3-panel'>Incorrect username or password.</div>";
        }
        
        $pdo = null;

    }

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="w3-container w3-margin-left">
        <div class="w3-card w3-light-gray">
            <header class="w3-container w3-blue w3-margin-top">
                <h1>Place a T-Shirt Order</h1>
            </header>
            
            <form action="<?php echo $phpScript; ?>" method="POST" class="w3-container" id="validationForm">
                <p>
                    <label class="w3-text-dark-grey" for = "usernameInput">Username</label>
                    <i id="usernameIcon" class="w3-large"></i>
                    <input required id = "usernameText" name="username" placeholder="Username" value="<?php echo $username; ?>" class="w3-input w3-border" autofocus>
                </p>
                <p>
                    <label class="w3-text-dark-grey" for = "passwordInput">Password</label>
                    <i id="passwordIcon" class="w3-large"></i>
                    <input required id = "passwordText" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" class="w3-input w3-border">
                </p>
                <p>
                    <button name="submit" class="w3-btn w3-green">Login</button>
                    &nbsp; or &nbsp;
                    <button id="register" class="w3-btn w3-blue w3-right-align" href = "Register.php">Register</button>
                        <script type="text/javascript">
                            document.getElementById("register").onclick = function () {
                            location.href = "Register.php";
                            };
                        </script>
                </p>
            </form>

           <h2 class="w3-container w3-text-red"><?php echo $errorMessage; ?></h2> 
        </div>
        <br>
        <br>
        <footer>&copy; <?php echo $curYear; ?> Daniel Meyer</footer>
        <script src="js/loginChecker.js"></script>
    </body>
</html>