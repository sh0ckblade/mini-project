<?php
session_start();

include 'connexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['email_pat'])) {
        $userId = $_SESSION['email_pat'];

        $firstName = mysqli_real_escape_string($conn, $_POST['editFirstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['editLastName']);
        $password = mysqli_real_escape_string($conn, $_POST['editPassword']);
        //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $updateQuery = "UPDATE patient SET nom_pat = '$firstName', prenom_pat = '$lastName', mp_pat = '$password' WHERE email_pat = '$userId'";
        echo "Query: $updateQuery<br>";

        if ($conn->query($updateQuery) === TRUE) {

            
            header("location:updateprofile.php");
            ob_end_flush(); 

            echo "Profile updated successfully!";

        } 
        else {
            echo "Error updating profile: " . $conn->error;
        }
    } else {
        echo "User not logged in!";
    }

//mysqli_query($conn,$updateQuery);
}
$conn->close();
?>
