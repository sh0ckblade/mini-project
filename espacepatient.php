<?php
session_start();
include 'connexion.php';
 if (!isset($_SESSION['email_pat'])) {
    // Redirect to the login page
    header("location: loginp.html");
    exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
<style>
  /* Style the select element */
  #doctor {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 16px;
  }

  /* Style the options within the select dropdown */
  #doctor option {
    background-color: #f1f1f1;
    color: #333;
  }

  /* Style the select element when it's focused */
  #doctor:focus {
    outline: none;
    border-color: #4CAF50; /* Change color when focused */
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
  

</style>

<title>Espace patient</title>
<link rel="stylesheet" href="patient.css">
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
                            <h3>  <b><?php echo $_SESSION['nom_pat'];?> </b></h3>
                        </div>
                        <hr>

                            <a href="updateprofile.php"  class="sub-menu-link"  >
                                <img src="profile.png" onclick="location.href='updateprofile.php'" >
                                <p>Edit Profile</p>
                                <span>></span>
                            </a>

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
        
        <br>
        <br>
        <br>
       

        
        <form action="reservation.php" method="POST">
            <div class="container">
              <h1>Make a Reservation</h1>
              <p>Please fill in this form to make a reservation.</p>
              <hr>
          
              <label for="doctor"><b>Select a Doctor :</b></label>
              <br>

              <br>

              <div class="select-container">


              <select id="doctor" name="doctor" required>
                    <?php
                    
            
                    // Fetch list of doctors from the database
                    $sql = "SELECT * FROM medecin";
                    $result = $conn->query($sql);

                    // Generate options for each doctor
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["nom_med"] . "'>" . $row["nom_med"] .  "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No doctors available</option>";
                    }
                    ?>
                </select>

            
             </div>
             <br>
             
               
             <label for="reservationDate"><b> Select Date: </b></label>
             <br>
             <input type="date" id="reservationDate" name="reservationDate" required>
             <br>
             <label for="reservationHour"> <b>Select Time: </b></label>
             <br>
             <input type="time" id="reservationHour" name="reservationHour" required>
             <br>
          
             
             
              <hr>
              <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
          
              <button type="submit" class="registerbtn">Submit Reservation</button>
            </div>
            
            
            
          </form>


          
             <br>

             <div class="container ">
            <h2> <b> Accepted Reservations </b> </h2>
            <br>

            <?php
            $patientEmail = $_SESSION['email_pat'];
            $get_patient_id = "SELECT id_pat FROM patient WHERE email_pat = '$patientEmail'";
$result_patient_id = $conn->query($get_patient_id);

if ($result_patient_id->num_rows > 0) {
    $row_patient_id = $result_patient_id->fetch_assoc();
    $patientId = $row_patient_id['id_pat'];
}

            // SQL query to select all records from the RDV table
            $sql = "SELECT * FROM RDV WHERE id_pat = '$patientId' AND etat_rdv = 'accepted'";
            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any records returned
            if ($result->num_rows > 0) {
                // Output data of each row
                echo "<ul>"; // Start unordered list
                while ($row = $result->fetch_assoc()) {
                    // Output list item for each appointment
                    echo "<li>Date: " . $row["date_RDV"] . " - Time: " . $row["heure_RDV"] . "</li>" ;

                    echo "</li>";
                    // Add more fields as needed
                }
                echo "</ul>"; // End unordered list
            } else {
                echo "No appointments found";
            }
            $conn->close();

            // Close the database connection
            
            
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
