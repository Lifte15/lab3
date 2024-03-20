<?php
// Start the session
session_start();
// Include the database connection 
include "db_conn.php";

// Redirect to login page if user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: loginform.php");
    exit();
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session 
    session_destroy(); // Destroy session
    header("Location: loginform.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body class="bg-danger">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-outline-danger">
                    <div class="card-header">
                        <!-- Heading with large text and centered alignment -->    
                        <h1 class="display-4 text-center text-danger">Logged in!</h1>
                    </div>
                    <div class="card-body">
                        <!-- Display a large text in the center -->
                        <h2 class="display-2 text-center text-danger">WOWWERS</h2>
                    </div>
                    <div class="card-footer">
                        <!-- Form to logout -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <!-- Button to submit the form -->
                            <button type="submit" name="logout" class="btn btn-outline-danger d-grid gap-2 col-6 mx-auto">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>
