<?php
include'connexion.php';

/*if(isset($_POST["submit"])){

$id_pat=$_POST['id_pat'];
$nom_pat=$_POST['nom_pat'];
$prenom_pat=$_POST['prenom_pat'];
$tel_pat=$_POST['tel_pat'];
$email_pat=$_POST['email_pat'];
$mp_pat=$_POST['mp_pat'];
$date_nais=$_POST['date_nais'];
$sexe=$_POST['sexe'];
}

$query="INSERT INTO patient VALUES ('$id_pat','$nom_pat','$prenom_pat','$tel_pat','$email_pat','$mp_pat','$date_nais','$sexe')";
mysqli_query($conn,$query);
echo"<script>  alert('Regestration successful');  </script>"*/




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstName = mysqli_real_escape_string($conn, $_POST['nom_pat']);
    $lastName = mysqli_real_escape_string($conn, $_POST['prenom_pat']);
    $email = mysqli_real_escape_string($conn, $_POST['email_pat']);
    $birth = mysqli_real_escape_string($conn, $_POST['date_nais']);
    $sexe = mysqli_real_escape_string($conn,$_POST['sexe']);
    $password = mysqli_real_escape_string($conn, $_POST['mp_pat']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel_pat']);
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

    // Check if the email is not already registered
    $checkQuery = "SELECT * FROM Patient WHERE email_pat = '$email'";
    $result = $conn->query($checkQuery);
    if ($result->num_rows > 0) {
        echo "Email already exists! Please choose a different email.";
    } else {
        // Insert the user data into the database
        $insertQuery = "INSERT INTO Patient (nom_pat, prenom_pat, email_pat,tel_pat, sexe,mp_pat, date_nais) VALUES ('$firstName', '$lastName', '$email','$tel', '$sexe', '$password', '$birth')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Registration successful!";
            header("location: loginp.html");
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>

?>
