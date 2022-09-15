<?php

     session_start();

     if ( !isset( $_SESSION['username'] ) ) {
         // If username variable is not set, then send them back to the login form.
         header('Location: Login.php');
     }

     $username = $_SESSION['username'];

    if($_SERVER['REQUEST_METHOD'] == 'POST' ){
        $size = $_POST['size'];
        $color = $_POST['color'];
        $design = $_POST['design'];
 
        try {
        $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', 'root');
    
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT orderNum
                        FROM orders 
                        WHERE username = '$username'
                        ORDER BY orderNum DESC
                ";

                $pdoStatement = $pdo->query($sql);
                $row = $pdoStatement->fetch();
                
                
                $orderNum = $row['orderNum'] + 1;



        $sql = 'INSERT INTO orders ' .
               '(username, size, color, design, orderNum)' .
               'VALUES' .
               "('$username', '$size' , '$color', '$design', '$orderNum')";
    
        if ( $pdo->exec($sql) ) {
            echo '<title>Order Confirmation</title>
                <div class = "w3-center  w3-margin">
                <h1 class = "w3-margin">Thank you for placing your order!</h1>',
                '<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">',
                '<p class = "w3-margin">
                    <button id="home" class="w3-btn w3-blue w3-right-align " href = "Home.php">
                        Return to your home page</button>
                    <script type="text/javascript">
                    document.getElementById("home").onclick = function () {
                    location.href = "Home.php";
                    };
                </script></p>
                <p class = "w3-margin">Or click here to log out and return to the login page
                <br>
                <br>
                <button id="login" class="w3-btn w3-green w3-right-align " href = "Login.php">
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
            die("Sorry, could not create your order.");
        }
    } catch (PDOException $e) {
    die ( $e->getMessage() );
    }   



}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Place An Order</title>
            <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <head>

    <body>
        <h1 class = "w3-center">Place your T-shirt Order</h1>
        <div class = "w3-margin">
        <form action="<?php echo $phpScript; ?>" method="POST" class="w3-container w3-sand">
        <p>     

                    <select class = "w3-dropdown" name = "size" required>
                        <option autofocus value = "">Select a size</option>
                        <option value = "Small" class="w3-bar-item w3-button">Small</option>
                        <option value = "Medium" class="w3-bar-item w3-button">Medium</option>
                        <option value = "Large" class="w3-bar-item w3-button">Large</option>
                        <option value = "X-Large" class="w3-bar-item w3-button">X-Large</option>
                        <option value = "XX-Large" class="w3-bar-item w3-button">XX-Large</option>
                        <option value = "XXX-Large " class="w3-bar-item w3-button">XXX-Large</option>
                    </select>


            

        </p>
        <p>
            <select class = "" name = "color" required>
                        <option autofocus value = "">Select a color</option>
                        <option value = "Blue" class="w3-bar-item w3-button">Blue</option>
                        <option value = "Red" class="w3-bar-item w3-button">Red</option>
                        <option value = "Yellow" class="w3-bar-item w3-button">Yellow</option>
                        <option value = "Green" class="w3-bar-item w3-button">Green</option>
                        <option value = "Black" class="w3-bar-item w3-button">Black</option>
                        <option value = "White" class="w3-bar-item w3-button">White</option>
                    </select>
            


        </p>
        <p>
            <select class = "" name = "design" required>
                        <option autofocus value = "">Select a design</option>
                        <option value = "1" class="w3-bar-item w3-button">1</option>
                        <option value = "2" class="w3-bar-item w3-button">2</option>
                        <option value = "3" class="w3-bar-item w3-button">3</option>
                        <option value = "4" class="w3-bar-item w3-button">4</option>
                        <option value = "5" class="w3-bar-item w3-button">5</option>
                        <option value = "6" class="w3-bar-item w3-button">6</option>
            </select>
        </p>
    

            <p> 
                <button name="submit" class="w3-btn w3-green">Save</button> 
                <span class="w3-text-red"><?php echo $formError; ?></span>
            <p>

    

        </form>
            <table class = "w3-table w3-border w3-bordered">
                <tr class = "w3-light-blue" >
                    <td class = "w3-center" colspan = "6">T-Shirt design key</td>
                </tr>
                <tr>
                    <td class = "w3-center">1</td>
                    <td class = "w3-center">2</td>
                    <td class = "w3-center">3</td>
                    <td class = "w3-center">4</td>
                    <td class = "w3-center">5</td>
                    <td class = "w3-center">6</td>
                </tr>
                <tr>
                    <td><img src = "images/design_1.png"></td>
                    <td><img src = "images/design_2.png"></td>
                    <td><img src = "images/design_3.png"></td>
                    <td><img src = "images/design_4.png"></td>
                    <td><img src = "images/design_5.png"></td>
                    <td><img src = "images/design_6.png"></td>
                </tr>
            </table>
        </div>

        <br>
        <br>    
        <p class = "w3-margin w3-center">
                    <button id="home" class="w3-btn w3-blue  " href = "Home.php">
                        Return to your home page</button>
                    <script type="text/javascript">
                    document.getElementById("home").onclick = function () {
                    location.href = "Home.php";
                    };
                </script>
        </p>


        <footer class="w3-container w3-center w3-text-gray">&copy; <?php echo $curYear; ?> Daniel Meyer</footer>
</html>