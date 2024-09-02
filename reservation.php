<?php
session_start();

include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['email_pat'])) {
        $userId = $_SESSION['id_pat'];

        
        $reservationDate = mysqli_real_escape_string($conn, $_POST['reservationDate']);
        $reservationHour = mysqli_real_escape_string($conn, $_POST['reservationHour']);
         
         $drname = mysqli_real_escape_string($conn,$_POST['doctor']);
             $sql_get_doctor_id = "SELECT id_med FROM medecin WHERE nom_med = '$drname'";

$result_get_doctor_id = $conn->query($sql_get_doctor_id);
    if ($result_get_doctor_id->num_rows > 0) {
        $row_get_doctor_id = $result_get_doctor_id->fetch_assoc();
        $doctorId = $row_get_doctor_id['id_med'];


        // Assuming RDV table has fields id_pat, date_RDV, heure_RDV, etat_rdv
        $insertQuery = "INSERT INTO rdv  VALUES ('','$userId','$doctorId' , '$reservationDate', '$reservationHour', 'pending')";
        
        if ($conn->query($insertQuery) === TRUE) {
           
            header('location:espacepatient.php');
            ob_end_flush();

             echo "Reservation made successfully!";

        } else {
            echo "Error making reservation: " . $conn->error;
        }
    } else {
        echo "User not logged in!";
    }
}}

$conn->close();
?>
