<?php

session_start();
include "connexion.php";

if (!isset($_SESSION['email_med'])) {
    // Redirect to the login page if not logged in
    header("location: loginD.html");
    exit();
}

// Check if the form is submitted and if the reservation ID is set
if (isset($_POST['reservation_id'])) {
    $reservationId = $_POST['reservation_id'];

    // Check if the "Accept" button is clicked
    if (isset($_POST['accept_reservation'])) {
        // Update the reservation status to "accepted"
        $acceptQuery = "UPDATE rdv SET etat_rdv = 'accepted' WHERE id_rdv = $reservationId";
        if ($conn->query($acceptQuery) === TRUE) {
            // Redirect back to the doctor profile page after accepting
            header("Location: espacedoctor.php");
            exit;
        } else {
            echo "Error accepting reservation: " . $conn->error;
        }
    }

    // Check if the "Reject" button is clicked
    if (isset($_POST['reject_reservation'])) {
        // Delete the reservation from the database
        $rejectQuery = "DELETE FROM rdv WHERE id_rdv = $reservationId";
        if ($conn->query($rejectQuery) === TRUE) {
            // Redirect back to the doctor profile page after rejecting
            header("Location: espacedoctor.php");
            exit;
        } else {
            echo "Error rejecting reservation: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
