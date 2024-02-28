<?php
session_start();
// Include the database connection file
include "db_conn.php";

// Function to sanitize and validate user input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and store user input in variables
    $uname = validate($_POST['uname']);
    $fname = validate($_POST['fname']);
    $mname = validate($_POST['mname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert user data into the database
    $sql = "INSERT INTO user (username, First_name, Middle_name, Lastname, Email, password) 
            VALUES ('$uname','$fname', '$mname', '$lname', '$email', '$hashed_password')";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // If registration is successful, set the username in the session and redirect to success page
        $_SESSION["username"] = $uname;  
        header("Location: success.php"); 
        exit();
    } else {
        // If registration fails, redirect to the registration form with an error message
        header("Location: registerform.php?error=Registration failed. Please try again.");
        exit();
    }
} else {
    header("Location: registerform.php");
    exit();
}
?>

