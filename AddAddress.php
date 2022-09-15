<?php
    
    session_start();

    if ( !isset( $_SESSION['username'] ) ) {
        // If username variable is not set, then send them back to the login form.
        header('Location: Login.php');
    }
    
    $username = $_SESSION['username'];

    function sanitizeValue($value) {
        return htmlspecialchars( stripslashes( trim( $value ) ) );
    }

    if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
        $street = sanitizeValue($_POST['street']);
        $city = sanitizeValue($_POST['city']);
        $state = $_POST['state'];
        $zip = sanitizeValue($_POST['zip']);

        
        
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', 'root');
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $del = "DELETE FROM addresses
                            WHERE username = '$username'
                    ";
            $deleted = $pdo->query($del);




            $sql = 'INSERT INTO addresses ' .
            '  (username, street, city, state, zip) ' .
            'VALUES ' .
            "  ('$username', '$street' , '$city', '$state', '$zip')";
            
            if ( $pdo->exec($sql) ) {
                echo '
                <title>Address Confirmation</title>
                <h1 class = "w3-margin w3-center">Your shipping address has been added.</h1>',
                '<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">',
                '<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">',
                '<p class = "w3-margin w3-center">
                    <button id="home" class="w3-btn w3-blue w3-center w3-center " href = "Home.php">
                        Return to your home page</button>
                    <script type="text/javascript">
                    document.getElementById("home").onclick = function () {
                    location.href = "Home.php";
                    };
                </script></p>
                <p class = "w3-margin w3-center">Or click here to log out and return to the login page
                <br>
                <br>
                <button id="login" class="w3-btn w3-green w3-right-align w3-center" href = "Login.php">
                        Logout</button>
                    <script type="text/javascript">
                    document.getElementById("login").onclick = function () {
                    location.href = "logout.php";
                    };
                </script>
                </p>
                <br>
                </div>
                ';
                $pdo = null;
                die;
            } else {
                die("Sorry, could not create your account.");
            }
        } catch (PDOException $e) {
            die ( $e->getMessage() );
        }   
        
        

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-container w3-margin-left">
    <div class="w3-card w3-light-gray">
            <header class="w3-container w3-blue w3-margin-top">
                <h1>Add a Shipping Address</h1>
            </header>
    <form action="<?php echo $phpScript; ?>" method="POST" class="w3-container">
        <p>
            <label>Street<span class="w3-text-red">*</span>: <input name="street" autofocus required></label>
        </p>
        <p>
            <label>City<span class="w3-text-red">*</span>: <input name="city" required></label>
        </p>
        <p>
        City<span class="w3-text-red">*</span>:
        <select class = "" name = "state" required>
    <option autofocus value = "">Select a State</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
    </select>	
        </p>
        <p>
            <label>zip<span class="w3-text-red">*</span>: <input name="zip" type = "number" required> </label>
        </p>
        <p>
        
            <input type="submit" class = "w3-btn w3-green w3-right-align" value="Add a Shipping Address">
        </p>
    </form>
    </div>
    <br><br>
    <p class = "w3-margin w3-center">
                    <button id="home" class="w3-btn w3-blue  " href = "Home.php">
                        Return to your home page</button>
                    <script type="text/javascript">
                    document.getElementById("home").onclick = function () {
                    location.href = "Home.php";
                    };
                </script>
        </p>

        <br>
        <footer class="w3-container w3-center w3-text-gray">&copy; <?php echo $curYear; ?> Daniel Meyer</footer>

</body>
</html>