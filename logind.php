<?php
session_start();

include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from the login form
    $email = $_POST['email_med'];
    $password = $_POST['mp_med'];

    // Query to fetch patient's record based on the provided email and password
    $sql = "SELECT * FROM medecin WHERE email_med = '$email' AND mp_med = '$password'";
    $result = $conn->query($sql);
    $row=mysqli_fetch_assoc($result);
    $id_med=$row['id_med'];
    $nom_med=$row['nom_med'];


    if ($result->num_rows == 1) {
        // Patient record found, set session variables and redirect to patient profile
        $_SESSION['email_med'] = $email;
        $_SESSION['id_med']=$id_med;
        $_SESSION['nom_med']=$nom_med;
        header("location: espacedoctor.php");
        exit();
    } else {
        // Patient record not found or password incorrect, show error message
        $error = "Invalid email or password";
    }
}
?>
