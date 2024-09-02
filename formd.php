<?php
include'connexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstName = mysqli_real_escape_string($conn, $_POST['nom_med']);
    
    $email = mysqli_real_escape_string($conn, $_POST['email_med']);
  
    $password = mysqli_real_escape_string($conn, $_POST['mp_med']);
  
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

    // Check if the email is not already registered
    $checkQuery = "SELECT * FROM medecin WHERE email_med = '$email'";
    $result = $conn->query($checkQuery);
    if ($result->num_rows > 0) {
        echo "Email already exists! Please choose a different email.";
    } else {
        // Insert the user data into the database
        $insertQuery = "INSERT INTO medecin (nom_med, email_med, mp_med) VALUES ('$firstName',  '$email',  '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Registration successful!";
            header("location: loginD.html");
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>

?>


?>