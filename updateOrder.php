<?php
    session_start();
    if ( !isset( $_SESSION['username'] ) ) {
        // If username variable is not set, then send them back to the login form.
        header('Location: Login.php');
    }
    
    $username = $_SESSION['username'];


    function generateTable(){

    
        $username = $_SESSION['username'];
        $conn = mysqli_connect("localhost", "root", "root", "project");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT orderNum, size, color, design 
                FROM orders 
                WHERE username = '$username'
                ORDER BY orderNum
              ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["orderNum"]. "</td><td>" . $row["size"] . "</td><td>"
                    . $row["color"] . "</td><td>". $row["design"]. "</td></tr>";
            }
                    
        }else { echo "<div>You currently have no orders placed.</div>"; }
            $conn->close();


    }

    
    $username = $_SESSION['username'];

    if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {

        $updateOrderNum = $_POST['userOrderNum'];
        $updatedSize = $_POST['size'];
        $updatedColor = $_POST['color'];
        $updatedDesign = $_POST['design'];
        
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', 'root');
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $del = "UPDATE orders
                    SET size = '$updatedSize',
                        color = '$updatedColor',
                        design = '$updatedDesign'
                    WHERE username = '$username'
                    AND orderNum = '$updateOrderNum'
                    ";
            $deleted = $pdo->query($del);

            $pdo = null;
            
        } catch (PDOException $e) {
            die ( $e->getMessage() );
        }  

    }

    


?>


<!DOCTYPE html>
<head>
        <title>Update an order</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>



    <body >
            <h1 class = "w3-center">Update an Order</h1>
        
        <div class = "w3-margin">
            <table id = "orderTable" class = "w3-table w3-striped w3-border w3-bordered ">
                <tr class = "w3-green">
                    <td>Order Number</td>
                    <td>Size</td>
                    <td>Color</td>
                    <td>Design</td>
                </tr>
                <?php generateTable(); ?>
            </table>

        </div>
        <form action="updateOrder.php" method="POST" class = "w3-container w3-margin w3-sand">
        <p class = "w3-margin">
            <label>Order number you would like to update
                <span class="w3-text-red">*</span>: 
                <br>
                <input name="userOrderNum" autofocus type = "number" required>
            </label>
        </p>
        <div class = "w3-margin">
        
        <p>     
                    <select class = "" name = "size" required>
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
    </form>





        
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
    </body>



</html>