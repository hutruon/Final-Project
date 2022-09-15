<?php
    session_start();

    if ( !isset( $_SESSION['username'] ) ) {
        
        header('Location: Login.php');
    }
    
    $username = $_SESSION['username'];

    $welcomeMessage = "<h1>Welcome $username</h1>";


    function generateTable(){
                $username = $_SESSION['username'];
                $conn = mysqli_connect("localhost", "root", "root", "project");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT size, color, design 
                        FROM orders 
                        WHERE username = '$username'
                        ORDER BY orderNum
                ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>"  . $row["size"] . "</td><td>"
                        . $row["color"] . "</td><td>". $row["design"]. "</td></tr>";
                    }
                    
                } 
                else { echo "<div>You currently have no orders placed.</div>"; }
                $conn->close();
    }

    function addAddressButton(){
        $username = $_SESSION['username'];
                 
                $conn = mysqli_connect("localhost", "root", "root", "project");
                
                $sql = "SELECT username
                        FROM addresses 
                        WHERE username = '$username'
                ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '<div class = "w3-center">
                    <button id = "changeAddress" class = "w3-btn w3-blue-grey w3-center" href = "AddAddress.php">Change your Shipping Address</button>
                    <script type="text/javascript">
                                document.getElementById("changeAddress").onclick = function () {
                                location.href = "AddAddress.php";
                                };
                            </script>
                <div>'; 
                    
                } 
                else { echo '<div class = "w3-center">
                    <button id = "newAddress" class = "w3-btn w3-blue-grey w3-center" href = "AddAddress.php">Add a Shipping Address</button>
                    <script type="text/javascript">
                                document.getElementById("newAddress").onclick = function () {
                                location.href = "AddAddress.php";
                                };
                            </script>
                <div>'; 
                }
                $conn->close();
    }


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>



    <body >
    
        <div class="w3-center">
            <?php echo $welcomeMessage; ?>
        </div>
        <div class = "w3-center w3-margin">
            <table id = "orderTable" class = "w3-table w3-striped w3-border w3-bordered">
                
                <tr class = "w3-teal">
                    <td>Size</td>
                    <td>Color</td>
                    <td>Design</td>
                </tr>
            <?php generateTable(); ?>
        </table>
        </div>
        
        <div class = "w3-center w3-margin">
            <table class = "w3-table w3-border w3-bordered">
                <tr class = "w3-light-blue" >
                    <td class = "w3-center" colspan = "6">T-Shirt design key</td>
                </tr>
                <tr>
                    <td class = "">1</td>
                    <td class = "">2</td>
                    <td class = "">3</td>
                    <td class = "">4</td>
                    <td class = "">5</td>
                    <td class = "">6</td>
                </tr>
                <tr>
                    <td><img src = "images/design_1.png" alt = "logo1" style="width:50%"></td>
                    <td><img src = "images/design_2.png" alt = "logo2" style="width:50%"></td>
                    <td><img src = "images/design_3.png" alt = "logo3" style="width:50%"></td>
                    <td><img src = "images/design_4.png" alt = "logo4" style="width:50%"></td>
                    <td><img src = "images/design_5.png" alt = "logo5" style="width:50%"></td>
                    <td><img src = "images/design_6.png" alt = "logo6" style="width:50%"></td>
                </tr>
            </table>
        </div>
        
        <div class = "w3-center">
            <button id = "newOrder" class = "w3-btn w3-blue w3-center" href = "AddShirt.php">Place a New T-shirt Order</button>
            <script type="text/javascript">
                        document.getElementById("newOrder").onclick = function () {
                        location.href = "AddShirt.php";
                        };
                    </script>
       
        &nbsp; or &nbsp; 
            <button id = "deleteOrder" class = "w3-btn w3-red w3-center" href = "deleteShirt.php">Delete a T-shirt Order</button>
            <script type="text/javascript">
                        document.getElementById("deleteOrder").onclick = function () {
                        location.href = "deleteShirt.php";
                        };
                    </script>
        &nbsp; or &nbsp; 
            <button id = "updateOrder" class = "w3-btn w3-blue w3-center" href = "deleteShirt.php">Update a T-shirt Order</button>
            <script type="text/javascript">
                        document.getElementById("updateOrder").onclick = function () {
                        location.href = "updateOrder.php";
                        };
                    </script>
         
        </div>
        <br>
        <?php addAddressButton();?>

        <div class = "w3-margin">
                <button id="login" class="w3-btn w3-green w3-right-align " href = "Login.php">
                        Logout</button>
                    <script type="text/javascript">
                    document.getElementById("login").onclick = function () {
                    location.href = "logout.php";
                    };
                </script>
        </div>


                    


        <footer class="w3-container w3-center w3-text-gray">&copy; <?php echo $curYear; ?> Daniel Meyer</footer>
    </body>
</html>