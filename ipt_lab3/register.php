<?php
// Start the session
session_start();
// Include the database connection 
include "db_conn.php";
// Import the PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to send email verification
function generateVerificationCode() {
    // Generate a random verification code
    return mt_rand(1000000, 9999999);
}

// Function to send email verification
function sendMail($email, $v_code) 
{
    // Include the required PHPMailer files
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'brianbognotipt101@gmail.com';                     
        $mail->Password   = 'dzgs vwfb zvli zuji';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
        $mail->Port       = 587;                                    
    
        //Recipients
        $mail->setFrom('brianbognotipt101@gmail.com', 'IPT101lab_3');
        $mail->addAddress($email);     

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Email Verification';
        $mail->Body    = "<h1>You have been Registered!</h1> 
                        <h5>Verify your email address to Login with the below code:</h5>
                        <br/><br/>
                        <h2>$v_code</h2>";

    
        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // If an exception occurs, return false
        return false;
    }

}

// Function to sanitize and validate user input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted using post method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and store user input in variables
    $uname = validate($_POST['uname']);
    $fname = validate($_POST['fname']);
    $mname = validate($_POST['mname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $cpassword = validate($_POST['cpassword']);
    $terms = isset($_POST['terms']);

    // Check the username if empty
    if (empty($uname)) {
        header("Location: registerform.php?error=User Name is required.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
    } 
    // Check the firstname if empty
    else if (empty($fname)) {
        header("Location: registerform.php?error=First Name is required.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
    }
    // Check the lastname if empty
    else if (empty($lname)) {
        header("Location: registerform.php?error=Last Name is required.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
    }
    // Check the email if empty
    else if (empty($email)) {
        header("Location: registerform.php?error=Email is required.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
    }
    // Check the password if empty
    else if (empty($password)) {
        header("Location: registerform.php?error=Password is required.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
    }
    // Check the second paswword if empty
    else if (empty($cpassword)) {
        header("Location: registerform.php?error=Second password is required.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
    }
    // If terms checkbox is not checked
    else if (!$terms) {
        header("Location: registerform.php?error=Please agree to the terms and conditions.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
    }
    // If both username and password are provided
    else {

        // Check the username if already exists
        $check_username_sql = "SELECT * FROM user WHERE username='$uname'";
        $resultu = mysqli_query($conn, $check_username_sql);
        if (mysqli_num_rows($resultu) > 0) {
        // Fetch the existing user data
        $user_data = mysqli_fetch_assoc($resultu);
        // Keep the existing values for username, name, email, and password
        $euname = $user_data['uname'];
        $efname = $user_data['fname'];
        $emname = $user_data['mname'];
        $elname = $user_data['mname'];
        $eemail = $user_data['email'];
        // Redirect to the registration form with a error message
        header("Location: registerform.php?error=Username already exists.&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
        exit();
        }
        // Check the passwords if matches
        if ($password !== $cpassword) {
            header("Location: registerform.php?error=Password don't match.&euname=" . urlencode($uname) . "&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&eemail=" . urlencode($email));
            exit();
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check the email if already exists
        $check_email_sql = "SELECT * FROM user WHERE email='$email'";
        $resulte = mysqli_query($conn, $check_email_sql);
        if (mysqli_num_rows($resulte) > 0) {
            // Redirect to the registration form with a error message
            header("Location: registerform.php?error=Email already exists.&efname=" . urlencode($fname) . "&emname=" . urlencode($mname) . "&elname=" . urlencode($lname) . "&euname=" . urlencode($uname));
            exit();
        }


        // Generate a verification code
        $v_code = generateVerificationCode();
        // SQL query to insert user data into the database
        $sql = "INSERT INTO user (username, first_name, middle_name, lastname, email, password, verification_code, is_verified) 
                VALUES ('$uname','$fname', '$mname', '$lname', '$email', '$hashed_password', '$v_code', '0')";

        // Execute the SQL query
        if (mysqli_query($conn, $sql)) {
            // Send verification email
            if (sendMail($email, $v_code)) {
                // If registration and email sending are successful, redirect to verify.php
                $_SESSION["email"] = $email;
                $_SESSION["uname"] = $uname;
                header("Location: success.php?success=Registration successful");
                exit();
            } else {
                // If sending email fails, redirect to registration form with error message
                header("Location: registerform.php?error=Failed to send verification email. Please try again.");
                exit();
            }
        } else {
            // If registration fails, redirect to registration form with error message
            header("Location: registerform.php?error=Registration failed. Please try again.");
            exit();
        }
    }
} else {
    header("Location: registerform.php");
    exit();
}
?>
