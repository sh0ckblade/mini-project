<?php
session_start();

// Include your database connection file
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from the login form
    $email = $_POST['email_pat'];
    $password = $_POST['mp_pat'];

    // Query to fetch patient's record based on the provided email and password
    $sql = "SELECT * FROM patient WHERE email_pat = '$email' AND mp_pat = '$password'";
    $result = $conn->query($sql);
    $row=mysqli_fetch_assoc($result);
    $id_pat=$row['id_pat'];
    $nom_pat=$row['nom_pat'];

    if ($result->num_rows == 1) {
        // Patient record found, set session variables and redirect to patient profile
        $_SESSION['email_pat'] = $email;
        $_SESSION['id_pat']=$id_pat;
        $_SESSION['nom_pat']=$nom_pat;
        header("location: espacepatient.php");
        exit();
    } else {
        // Patient record not found or password incorrect, show error message
        $error = "Invalid email or password";
    }
}
?>
