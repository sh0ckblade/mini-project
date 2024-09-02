<?php
session_start();
include 'connexion.php';
 if (!isset($_SESSION['email_pat'])) {
    // Redirect to the login page
    header("location: loginp.html");
    exit(); }
?>

<html>

<head>

<title>Edit Profile</title>
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
                            <h3>  User </h3>
                        </div>
                        <hr>

                           

                            <a href="#"  class="sub-menu-link" >
                                <img src="setting.png">
                                <p>Settings & Privacy </p>
                                <span>></span>
                            </a>

                            <a href="espacepatient.php"  class="sub-menu-link"  >
                                <img src="profile.png" onclick="location.href='espacepatient.php'" >
                                <p>User Profile</p>
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
        
        
        <form action="update.php" method="POST">
            <div class="container">
              <h1>Edit Profile</h1>
              <p>Please fill in this form to Update your account.</p>
              <hr>
          
              <label for="name"><b>Edit First Name :</b></label>
              <input type="text" placeholder="Enter First Name" name="editFirstName" id="editFirstName" required>
          
              <label for="lastname"><b>Edit Last Name :</b></label>
              <input type="text" placeholder="Enter Last Name" name="editLastName" id=editLastName required>
          
              <label for="password"><b>Update Password :</b></label>
              <input type="password" placeholder="Update Password" name="editPassword"  id="editPassword" required>
              <hr>
              <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
          
              <button type="submit" class="registerbtn">Update</button>
            </div>
            
            
          </form>
    </div>

<script>

        let subMenu = document.getElementById("subMenu");
        
        function toggleMenu(){
            subMenu.classList.toggle("open-menu");
        }

</script>





</body>

</html>
