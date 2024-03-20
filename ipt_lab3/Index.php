<?php
// Start the session
session_start();
// Include the database connection 
include "db_conn.php";

// Check the username and password if provided
if (isset($_POST['uname']) && isset($_POST['password'])) {
    // Function to validate user input
    function validate($data){
        $data = trim($data);   
        $data = stripslashes($data);   
        $data = htmlspecialchars($data);   
        return $data;
    }
    // Validate the provided username and password
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    // Check the username and password if empty
    if (empty($uname) && empty($pass)) {
        header("Location: loginform.php?error=User Name and Password is required");
        exit();
    } 
    // Check the username if empty
    else if (empty($uname)) {
        header("Location: loginform.php?error=User Name is required");
        exit();
    }
    // Check the password if empty
    else if (empty($pass)) {
        header("Location: loginform.php?error=Password is required");
        exit();
    }
    // If both username and password are provided
    else {
        // SQL query to select user data based on the username
        $sql = "SELECT * FROM user WHERE username='$uname'";
        $result = mysqli_query($conn, $sql);

        // Check if the query returned exactly one row
        if (mysqli_num_rows($result) === 1) {
            // Get the user data as an associative array
            $row = mysqli_fetch_assoc($result);
            // Check if the user's email is verified
            if($row['is_verified'] == 1)
            {
                 // Check if the provided password matches the hashed password in the db
                 if (password_verify($pass, $row['password'])) {
                    echo "Logged in!";
                    // Store user data in the session
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["id"] = $row['id'];
                    // Redirect to the home page
                    header("Location: home.php");
                    exit();
                } else {
                    // Redirect with a error message if the password is incorrect
                    header("Location: loginform.php?error=Incorrect password"); 
                    exit();
                }
            }
            else {
                // Redirect with a error message if the email is not verified
                header("Location: successemail.php?error=Check your Email to get the OTP");
                exit();
            }
        } else {
            // Redirect with a error message if the user name or password is incorrect
            header("Location: loginform.php?error=Incorrect User Name or Password");
            exit();
        }
    }
} else {
    // Redirect if the username or password is not provided
    header("Location: loginform.php");
    exit();
}
?>
