<?php
session_start();
include 'connexion.php';
 if (!isset($_SESSION['email_med'])) {
    // Redirect to the login page
    header("location: loginD.html");
    exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <style>
        
.accept-btn {
    width: 20%;
    flex-basis: 48%;
    background: #008000;
    color: #fff;
    height: 40px;
    border-radius: 20px;
    border: 0;
    outline: 0;
    cursor: pointer;
    transition: background 1s;
    text-align: center;
}
.reject-btn {
    width: 20%;
    flex-basis: 48%;
    background: #FF0000;
    color: #fff;
    height: 40px;
    border-radius: 20px;
    border: 0;
    outline: 0;
    cursor: pointer;
    transition: background 1s;
    text-align: center;
}
.reservation-list {
    align-content: center;
    height: 20%;
    width: 50%;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 8px;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);

}

* {
        box-sizing: border-box;
      }
      .container {
        
        margin: 0 auto;
        
        max-width: 600px;
         width: 100%;
         background: #fff;
         padding: 25px 30px;
         border-radius: 10px;
     
     }

     
     * {
        box-sizing: border-box;
      }
      .container2 {
        
        margin: 0 auto;
        
        max-width: 600px;
         width: 100%;
         background: #fff;
         padding: 25px 30px;
         border-radius: 10px;
     
     }




    </style>

<title>Espace Doctor</title>
<link rel="stylesheet" href="doctor.css">
</head>

<body>
    
    
    <div class="hero">
        
        <nav>
            <img src="logo.png" class="logo" onclick="location.href='home.html'">
 
            <ul>
                <li> <a href="home.html">HOME</a> </li>
                <li> <a href="#">ABOUT</a> </li>
                <li> <a href="#">CONTACT</a> </li>
            </ul>
            <img src="user.png" class="user-pic" onclick="toggleMenu()">
            


                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="user.png" >
                            <h3>  <b><?php echo $_SESSION['nom_med'];?> </b></h3>
                        </div>
                        <hr>

                            

                            <a href="#"  class="sub-menu-link" >
                                <img src="setting.png">
                                <p>Settings & Privacy </p>
                                <span>></span>
                            </a>

                            <a href="#"  class="sub-menu-link" >
                                <img src="help.png">
                                <p>Help & Support</p>
                                <span>></span>
                            </a>

                            <a href="logout.php"  class="sub-menu-link" >
                                <img src="logout.png">
                                <p>Logout</p>
                                <span>></span>
                            </a>

                    </div>
                </div>



        </nav>
        <br>

        
        



        <div class="container ">
            <h2> <b> Reservation Requests </b> </h2>

            <?php
            $doctorEmail = $_SESSION['email_med'];
            $get_doctor_id = "SELECT id_med FROM medecin WHERE email_med = '$doctorEmail'";
$result_doctor_id = $conn->query($get_doctor_id);

if ($result_doctor_id->num_rows > 0) {
    $row_doctor_id = $result_doctor_id->fetch_assoc();
    $doctorId = $row_doctor_id['id_med'];
}

            // SQL query to select all records from the RDV table
            $sql = "SELECT * FROM RDV WHERE id_med = '$doctorId'";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any records returned
            if ($result->num_rows > 0) {
                // Output data of each row
                echo "<ul>"; // Start unordered list
                while ($row = $result->fetch_assoc()) {
                    // Output list item for each appointment
                    echo  "<li>Date: " . $row["date_RDV"] . " - Time: " . $row["heure_RDV"] ;

                    // Add accept and reject buttons with CSS class
                    
                    echo "<form method='POST' action='process_reservation.php'>";
                    echo "<input type='hidden' name='reservation_id' value='" . $row["id_rdv"] . "'>";
                    echo "<button type='submit' name='accept_reservation' class='accept-btn'> <b> Accept </b>  </button>";
                    
                    echo "<button type='submit' name='reject_reservation' class='reject-btn'> <b>  Reject </b>  </button>";
                    echo"<br>";
                    echo"<br>";
                    echo"<br>";
                    
                    echo "</form>";

                    echo "</li>";
                    // Add more fields as needed
                }
                echo "</ul>"; // End unordered list
            } else {
                echo "No appointments found";
            }

            // Close the database connection
            
            ?>
            
        </div>
        <br>

        <div class="container2">
            <h2>Accepted Reservations</h2>
            
            <?php
            $sql_accepted = "SELECT * FROM RDV WHERE id_med = '$doctorId' AND etat_rdv = 'accepted'";
            $result_accepted = $conn->query($sql_accepted);

            if ($result_accepted->num_rows > 0) {
                echo "<ul>"; // Start unordered list
                while ($row = $result_accepted->fetch_assoc()) {
                    // Display accepted reservation details
                    echo "<li>Date: " . $row["date_RDV"] . " - Time: " . $row["heure_RDV"] . "</li>";
                }
                echo "</ul>"; // End unordered list
            } else {
                echo "<p>No accepted reservations</p>";
            }
            $conn->close();
            ?>
        </div>
        
        
          
    </div>

  

<script>

        let subMenu = document.getElementById("subMenu");
        
        function toggleMenu(){
            subMenu.classList.toggle("open-menu");
        }

</script>


</body>

</html>
