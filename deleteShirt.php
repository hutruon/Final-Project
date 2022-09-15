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
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["orderNum"]. "</td><td>" . $row["size"] . "</td><td>"
                        . $row["color"] . "</td><td>". $row["design"]. "</td></tr>";
                    }
                    
                } 
                else { echo "<div >You currently have no orders placed.</div>"; }
                $conn->close();


    }

    
        $username = $_SESSION['username'];
        if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
            $delOrderNum = $_POST['userOrderNum'];
        
            
        
                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', 'root');
            
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $del = "DELETE FROM orders
                            WHERE username = '$username'
                            AND orderNum = '$delOrderNum'
                        ";
                    $deleted = $pdo->query($del);

                    $conn = mysqli_connect("localhost", "root", "root", "project");

                    $sql = "SELECT orderNum FROM orders
                            WHERE username = '$username'
                            ORDER BY orderNum
                    ";

                    $result = $conn->query($sql);

                    $intCounter = 1;
                    while($row = $result->fetch_assoc()) {
                        $newNum = $row["orderNum"];
                        $sql = "UPDATE orders
                                SET orderNum = '$intCounter'
                                WHERE orderNum = '$newNum'
                        ";
                        $intCounter++;
                        $update = $conn->query($sql);
                        
                    }
                    
                    

                    $conn->close();

                    $pdo = null;

                    
            
                } catch (PDOException $e) {
                die ( $e->getMessage() );
                }   

            }

    


?>


<!DOCTYPE html>
<head>
        <title>Delete an order</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>



    <body >
            <h1 class = "w3-center">Delete an Order</h1>
        <div class = "w3-margin">
            <table id = "orderTable" class = "w3-table w3-striped w3-border w3-bordered ">
                <tr class = "w3-red">
                    <td>Order Number</td>
                    <td>Size</td>
                    <td>Color</td>
                    <td>Design</td>
                </tr>
                <?php generateTable(); ?>
            </table>

        </div>
        
        <form action="deleteShirt.php" method="POST" class = "w3-container w3-center">
        <p>
            <label>Order number you would like to delete<span class="w3-text-red">*</span>: <br><input name="userOrderNum" autofocus type = "number" required></label>
        </p>
        <p>
            <input type="submit" class = "w3-btn w3-deep-orange w3-right-align" value="Delete">
        </p>
    </form>

        <br>
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
    </body>



</html>