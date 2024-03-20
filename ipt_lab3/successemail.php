<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the webpage -->
    <title>OTP VERIFY</title>
    <!-- Link to the Bootstrap CSS file -->
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    
</head>

<body style="background-image: url('twice-i-got-you-members-4k-wallpaper-uhdpaper.com-817@1@n.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
    ">
    <!-- Container to center content, with top margin -->
    <div class="container mt-5" >
        <!-- Row to justify content in the center -->
        <div class="row justify-content-center">
            <!-- Column with medium width -->
            <div class="col-md-6">
                <!-- Card with a border and secondary outline -->
                <div class="card border-outline-secondary" style="backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.5);">
                    <!-- Card header containing a form with action to index.php -->
                    <div class="card-header">
                        <form action="verifyemail.php" method="post">
                        <!-- Heading with large text and centered alignment -->    
                        <h1  class="display-4 text-center text-warning">OTP VERIFY</h1>
                    </div>    
                    <!-- Card body for main content -->
                    <div class="card-body">
                        <?php if (isset($_GET['error'])) { ?>
                            <!-- Paragraph with error styling and text from GET parameter -->
                            <p class="error display-6 text-decoration-underline text-danger text-center"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <!-- Paragraph with error styling and text from GET parameter -->
                            <p class="success display-6 text-decoration-underline text-success text-center"><?php echo $_GET['success']; ?></p>
                        <?php } ?>
                        <!-- Form group for username input -->
                        <div class="form-group">
                            <label class="display-6 text-start text-warning">Email</label>
                            <!-- Input field for username -->
                            <input type="text" class="form-control form-control-lg bg-white fs-6" name="emails" placeholder="Enter your email" ><br>
                        </div>
                        <div class="form-group">
                            <label class="display-6 text-start text-warning">OTP</label>
                            <!-- Input field for username -->
                            <input type="text" class="form-control form-control-lg bg-white fs-6" name="user_otp" placeholder="Enter OTP to verify email" ><br>
                        </div>
                        <!-- Button to submit the login form -->
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-outline-warning" type="submit">VERIFY</button>
                        </div>    
                    </div>
                <!-- Card footer containing a link to the registration form -->    
                <div class="card-footer">
                    <!-- Paragraph with a link to the registration form -->
                    <p class="text-warning">Already verified? <a href="loginform.php">Login here</a></p>
                </form>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
